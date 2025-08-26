import sqlite3
DB_PATH = r"C:\Users\10879\OneDrive - EFACEC Power Solutions, SGPS, SA\Desktop\isep\base de dados\efacec\meubanco.db"
con = sqlite3.connect(DB_PATH)
cur = con.cursor()
cur.execute("SELECT subprojecto FROM t_parcial_core WHERE subprojecto LIKE '%E1111472A%'")
print(cur.fetchall())
con.close()
