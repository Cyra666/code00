<?php

// 检查是否为 POST 请求
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取表单数据
    $username = $_POST['username'] ?? '';
    $realname = $_POST['realname'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';
    $hobbies = isset($_POST['hobbies']) ? $_POST['hobbies'] : [];

    // 输出表单数据
    echo "<pre>";
    echo "用户姓名: " . htmlspecialchars($username) . "\n";
    echo "真实姓名: " . htmlspecialchars($realname) . "\n";
    echo "密码: " . htmlspecialchars($password) . "\n";
    echo "确认密码: " . htmlspecialchars($confirm_password) . "\n";
    echo "性别: " . htmlspecialchars($gender) . "\n";
    echo "手机号码: " . htmlspecialchars($mobile) . "\n";
    echo "电子邮箱: " . htmlspecialchars($email) . "\n";
    echo "居住地址: " . htmlspecialchars($address) . "\n";
    echo "爱好: " . implode(", ", array_map('htmlspecialchars', $hobbies)) . "\n";
    echo "</pre>";

    // 检查是否有文件上传
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "uploads/";  // 图片存储目录
        $target_file = $target_dir . basename($_FILES["avatar"]["name"]);

        // 检查目标目录是否存在，如果不存在则创建
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // 移动上传的文件
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
            echo "文件上传成功。<br>";

            // 显示上传的图片
            echo "<img src='uploads/" . basename($_FILES["avatar"]["name"]) . "' alt='上传的图片'>";
        } else {
            echo "文件上传失败。<br>";
        }
    } else {
        echo "没有文件上传或上传失败。<br>";
    }

    // 获取个人说明
    $bio = isset($_POST['bio']) ? htmlspecialchars($_POST['bio']) : '';

    // 输出个人说明
    echo "个人说明: " . $bio . "<br>";
} else {
    echo "无效的请求方法";
}
?>