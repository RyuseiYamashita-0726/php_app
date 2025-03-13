<!DOCTYPE html>
<html lang='ja'>
<head>
    <meta charset="UTF-8">
    <title>新規作成</title>
</head>
<body>
    <form action="store.php" method="post">
<!--formタグのaction属性で入力されたデータの送信先を記述。
method属性で送信様式を記述。 -->
        <input type="text" name="content">
<!--inputタグのtype属性でテキスト入力欄を追加。 -->
<!--inputタグのname属性で送信時に$_POST['content']で受け取る -->
        <input type= "submit" value="作成">
<!--inputタグのtype属性で送信ボタンを追加。押下でaction属性
の指定先へデータを送信。 -->
<!--inputタグのvalue属性で送信ボタンの表示を”作成”にした。 -->
    </form>
<div>
    <a href="index.php">一覧へもどる</a>
</div>

</body>
</html>