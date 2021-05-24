<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
<p>
<?php
  $host = '127.0.0.1';
  $db   = 'Fantasy_Taverns';
  $charset = 'utf8mb4';
  $config = parse_ini_file("../../sqlcentos");
//$con = new PDO($config['type'].":host=".$config['host'].";dbname=".$config['dbname'], $config['username'], $config['password']);

  $passwdHash = password_hash("password",PASSWORD_DEFAULT);
  $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
  $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
  ];
  try {
       //$pdo = new PDO($dsn, $user, $pass, $options);
       $pdo = new PDO($dsn, $config['user'], $config['password'], $options);
  } catch (\PDOException $e) {
       throw new \PDOException($e->getMessage(), (int)$e->getCode());
  }

//$query = "INSERT INTO Users (name,passsword,dateOfBirth) VALUES
//(Thomas,$passwdHash,251088)";
  $stmt = $pdo->prepare('INSERT INTO Users (name,password,dateOfBirth) VALUES (?,?,?)');
  $stmt->execute(['Thomas',$passwdHash,251088]);

  $stmt = $pdo->query('SELECT name,password,dateOfBirth FROM Users');
  while ($row = $stmt->fetch()){
    echo $row['name'] . " "  . $row['dateOfBirth']. "\n";
    if (password_verify("password",$row['password'])){
      echo "true \n";
    } else {
  echo "false \n";
    }
  }
?>
</p>
</body>
</html>
