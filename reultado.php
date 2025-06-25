<?php
// Abre a base de dados SQLite (transformadores.db tem de estar na mesma pasta)
$db = new SQLite3('transformadores.db');

$id = $_GET['id'] ?? '';
$id = SQLite3::escapeString($id);

$dados = null;
if ($id !== '') {
    $query = "SELECT * FROM parcialcore WHERE id_secagenscore = '$id'";
    $result = $db->query($query);
    $dados = $result->fetchArray(SQLITE3_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
  <meta charset="UTF-8" />
  <title>Consulta Transformador</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 40px; max-width: 600px; }
    input, button { padding: 8px 10px; margin: 10px 0; font-size: 16px; }
    #resultado { margin-top: 20px; padding: 15px; border: 2px solid #333; background: #f4f4f4; }
  </style>
</head>
<body>

<h1>Consulta de Transformador</h1>

<form method="get">
  <label for="idInput">Insere o ID do transformador (id_secagenscore):</label><br>
  <input type="text" id="idInput" name="id" placeholder="Ex: 41" value="<?php echo htmlspecialchars($id); ?>" />
  <button type="submit">Procurar</button>
</form>

<div id="resultado">
<?php
if ($id === '') {
    echo "Insere um ID e carrega em Procurar.";
} elseif (!$dados) {
    echo "ID não encontrado na base de dados.";
} else {
    echo "<h2>Resultados para ID: " . htmlspecialchars($id) . "</h2>";
    echo "<p><strong>Potência:</strong> " . htmlspecialchars($dados['potencia']) . "</p>";
    echo "<p><strong>Tensão:</strong> " . h

