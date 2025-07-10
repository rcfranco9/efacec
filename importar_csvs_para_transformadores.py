import sqlite3
import pandas as pd

# URL base dos ficheiros CSV no GitHub
base_url = 'https://raw.githubusercontent.com/rcfranco9/efacec/main/'

# Ficheiros CSV e nomes das tabelas a criar
ficheiros = {
    'hitssecagemcore.csv': 'hitssecagemcore',
    'parcialcore.csv': 'parcialcore',
    't_programascore.csv': 't_programascore',
    'Secagens Core.csv': 'secagens_core'  # nome de tabela sem espaços
}

# Conecta à base de dados existente
conn = sqlite3.connect('transformadores.db')

# Importa cada CSV
for nome_ficheiro, nome_tabela in ficheiros.items():
    url = base_url + nome_ficheiro.replace(' ', '%20')
    print(f'📥 A importar {nome_ficheiro} → tabela "{nome_tabela}"...')
    try:
        df = pd.read_csv(url)
        df.to_sql(nome_tabela, conn, if_exists='replace', index=False)
        print(f'✅ Sucesso ao importar para {nome_tabela}\n')
    except Exception as e:
        print(f'❌ Erro com {nome_ficheiro}: {e}\n')

conn.close()
