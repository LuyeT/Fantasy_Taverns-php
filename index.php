<?php
  $host = '127.0.0.1';
  $db   = 'Fantasy_Taverns';
  $user = 'Luye';
  $pass = 'spikecube';
  $charset = 'utf8mb4';

  $passwdHash = password_hash("password",PASSWORD_DEFAULT);
  $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
  $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
  ];
  try {
       $pdo = new PDO($dsn, $user, $pass, $options);
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
