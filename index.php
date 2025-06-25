<?php
// Abre a DB
$db = new SQLite3('transformadores.db');

// Inicializa resultado vazio
$resultado = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara a query (usa prepared statements para segurança)
    $stmt = $db->prepare('SELECT * FROM parcialcore WHERE id_secagenscore = :id');
    $stmt->bindValue(':id', $id, SQLITE3_TEXT);

    $res = $stmt->execute();

    $resultado = $res->fetchArray(SQLITE3_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8" />
<title>Consulta Transformador</title>
<style>
  body { font-family: Arial, sans-serif; margin: 40px; }
  input, button { font-size: 16px; padding: 8px; margin: 10px 0; }
  .resultado { border: 1px solid #333; padding: 20px; margin-top: 20px; background: #f4f4f4; }
</style>
</head>
<body>

<h1>Consulta Transformador</h1>

<form method="GET" action="index.php">
  <label for="id">ID do transformador (id_secagenscore):</label><br>
  <input type="text" id="id" name="id" required value="<?php echo isset($id) ? htmlspecialchars($id) : ''; ?>" />
  <button type="submit">Procurar</button>
</form>

<?php if ($resultado): ?>
  <div class="resultado">
    <h2>Resultados para ID: <?php echo htmlspecialchars($id); ?></h2>
    <p><strong>Potência:</strong> <?php echo htmlspecialchars($resultado['potencia']); ?></p>
    <p><strong>Tensão:</strong> <?php echo htmlspecialchars($resultado['tensao']); ?></p>
    <p><strong>Massat:</strong> <?php echo htmlspecialchars($resultado['massat']); ?></p>
    <p><strong>Massai:</strong> <?php echo htmlspecialchars($resultado['massai']); ?></p>
  </div>
<?php elseif (isset($id)): ?>
  <p>Nenhum resultado encontrado para o ID "<?php echo htmlspecialchars($id); ?>"</p>
<?php endif; ?>

</body>
</html>

