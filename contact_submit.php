<?php
// 세션 먼저 시작 (lib.php 충돌 방지)
@session_start();

// Output buffering 시작 (lib.php의 출력 차단)
ob_start();

// Fatal 에러 핸들러
function fatalErrorHandler() {
    $error = error_get_last();
    if ($error !== null && ($error['type'] == E_ERROR || $error['type'] == E_PARSE || $error['type'] == E_CORE_ERROR || $error['type'] == E_COMPILE_ERROR)) {
        @ob_end_clean();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(array('success' => false, 'message' => "Fatal Error: " . $error['message'] . " in " . $error['file'] . " on line " . $error['line']));
    }
}
register_shutdown_function('fatalErrorHandler');

// 일반 에러 핸들러
function jsonErrorHandler($errno, $errstr, $errfile, $errline) {
    // 경고는 무시
    if ($errno == E_WARNING || $errno == E_NOTICE || $errno == E_DEPRECATED || $errno == E_STRICT) {
        return true;
    }
    @ob_end_clean();
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array('success' => false, 'message' => "PHP Error: $errstr in $errfile on line $errline"));
    exit;
}
set_error_handler('jsonErrorHandler');

// DB 연결 (운영서버 lib.php 사용)
$libPath = $_SERVER['DOCUMENT_ROOT'].'/web/lib.php';
if(!file_exists($libPath)) {
    @ob_end_clean();
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array('success' => false, 'message' => 'lib.php 파일을 찾을 수 없습니다: ' . $libPath));
    exit;
}
@include_once($libPath);

// lib.php 출력 버리기
@ob_end_clean();

header('Content-Type: application/json; charset=utf-8');

// DB 연결 확인
if(!isset($inquiry_table) || !$inquiry_table) {
    echo json_encode(array('success' => false, 'message' => 'DB 연결에 실패했습니다.'));
    exit;
}

// POST 요청만 허용
if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array('success' => false, 'message' => '잘못된 요청입니다.'));
    exit;
}

// 필수 필드 검증
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';
$privacy = isset($_POST['privacy']) ? $_POST['privacy'] : '';

if(empty($name)) {
    echo json_encode(array('success' => false, 'message' => '이름을 입력해주세요.'));
    exit;
}
if(empty($email)) {
    echo json_encode(array('success' => false, 'message' => '이메일을 입력해주세요.'));
    exit;
}
if(empty($title)) {
    echo json_encode(array('success' => false, 'message' => '제목을 입력해주세요.'));
    exit;
}
if(empty($message)) {
    echo json_encode(array('success' => false, 'message' => '메세지를 입력해주세요.'));
    exit;
}
if($privacy !== '동의함') {
    echo json_encode(array('success' => false, 'message' => '개인정보 수집·이용에 동의해주세요.'));
    exit;
}

// 추가 필드
$university = isset($_POST['university']) ? trim($_POST['university']) : '';
$type = isset($_POST['type']) ? implode(', ', $_POST['type']) : '';
$english = isset($_POST['english']) ? implode(', ', $_POST['english']) : '';
$score = isset($_POST['score']) ? trim($_POST['score']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

// 메모 내용 구성 (추가 정보 포함)
$memo = '';
if($university) $memo .= "전적대학교 및 학과: $university\n";
if($type) $memo .= "전형: $type\n";
if($english) $memo .= "공인영어: $english\n";
if($score) $memo .= "점수: $score\n";
$memo .= "\n--- 문의 내용 ---\n";
$memo .= $message;

// 접속 환경 감지
$device = '';
$userAgent = $_SERVER['HTTP_USER_AGENT'];
if(preg_match('/Mobile|Android|iPhone|iPad/i', $userAgent)) {
    $device = 'Mobile';
} else {
    $device = 'PC';
}

// IP 주소
$ip = $_SERVER['REMOTE_ADDR'];

// 파일 업로드 처리
// 새 페이지는 루트(/)에, 원본은 /web/에 있음
// 파일은 /upload/inquiry/에 저장 (루트 기준)
$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/upload/inquiry/';
if(!is_dir($uploadDir)) {
    @mkdir($uploadDir, 0755, true);
}

$uploadedFiles = array();
for($i = 1; $i <= 3; $i++) {
    $fileKey = 'file' . $i;
    if(isset($_FILES[$fileKey]) && $_FILES[$fileKey]['size'] > 0) {
        $file = $_FILES[$fileKey];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        // 허용 확장자 체크
        $allowedExt = array('jpg', 'jpeg', 'gif', 'png', 'webp', 'pdf', 'doc', 'docx', 'hwp', 'zip');
        if(!in_array($ext, $allowedExt)) {
            continue;
        }

        // 파일 크기 체크 (10MB)
        if($file['size'] > 10 * 1024 * 1024) {
            continue;
        }

        $newFilename = 'inquiry_' . date('YmdHis') . '_' . $i . '.' . $ext;
        if(move_uploaded_file($file['tmp_name'], $uploadDir . $newFilename)) {
            $uploadedFiles[] = $newFilename;
        }
    }
}

// 파일명 저장 (첫 번째 파일만 ifile에 저장, 나머지는 메모에 추가)
$ifile = '';
if(count($uploadedFiles) > 0) {
    $ifile = $uploadedFiles[0];
    if(count($uploadedFiles) > 1) {
        $memo .= "\n\n--- 추가 첨부파일 ---\n";
        for($i = 1; $i < count($uploadedFiles); $i++) {
            $memo .= $uploadedFiles[$i] . "\n";
        }
    }
}

// 세션 UID 생성 (원본 방식 참고)
if(!isset($_SESSION["session_uid"])) {
    srand((double)microtime()*1000000);
    $random_num = rand(100,999);
    $time = time();
    $_SESSION["session_uid"] = $time."-".$random_num;
}
$uid = $_SESSION["session_uid"];

// DB 저장 (원본 방식: 먼저 INSERT 후 파일 UPDATE)
// 원본: ('', '$name', '$email', '$subject', '$memo', '', '$uid', '$device', '$this_ip', '', '5', now())
$sql = "INSERT INTO $inquiry_table VALUES (
            '',
            '".addslashes($name)."',
            '".addslashes($email)."',
            '".addslashes($title)."',
            '".addslashes($memo)."',
            '',
            '".addslashes($uid)."',
            '".addslashes($device)."',
            '".addslashes($ip)."',
            '',
            '5',
            NOW()
        )";

$result = @mysql_query($sql);

if($result) {
    // 원본처럼 INSERT 후 파일 UPDATE
    $ino = @mysql_insert_id();
    if($ifile && $ino) {
        $sql_file = "UPDATE $inquiry_table SET ifile='".addslashes($ifile)."' WHERE ino='$ino'";
        @mysql_query($sql_file);
    }
    echo json_encode(array('success' => true, 'message' => '문의가 정상적으로 접수되었습니다.'));
} else {
    $error = @mysql_error();
    echo json_encode(array('success' => false, 'message' => '문의 접수 중 오류가 발생했습니다. ' . $error));
}

@mysql_close($connect);
?>
