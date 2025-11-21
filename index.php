<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Prezentare Proiect - Aplicatie Transport</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f6f6f6; }
        header { background: #2e8b57; padding: 20px; color: white; text-align: center; }
        section { max-width: 900px; margin: 20px auto; background: white; padding: 20px; border-radius: 8px; }
        h2 { color: #1f4e79; }
        ul { line-height: 1.6; }
    </style>
</head>
<body>
<header>
    <h1>Aplicatie Web pentru Companie de Transport</h1>
    <h3>Prezentare Proiect</h3>
</header>

<section>
    <h2>1. Descriere Generala</h2>
    <p>Aplicatia web permite gestionarea operatiunilor unei companii de transport: curse, soferi, vehicule, clienti si rapoarte.Cursele se vor realiza intre orase mari din toata tara. Sistemul va fi accesibil online si va utiliza PHP si MySQL pentru implementarea backend-ului.</p>
</section>

<section>
    <h2>2. Roluri</h2>
    <ul>
        <li><strong>Administrator</strong> – gestioneaza utilizatori, vehicule, soferi, configurari.</li>
        <li><strong>Dispatcher/Operator</strong> – gestioneaza curse si asignari.</li>
        <li><strong>Sofer</strong> – vizualizeaza curse asignate si actualizeaza status.</li>
        <li><strong>Client</strong> – plaseaza comenzi si vizualizeaza informatii despre transport.</li>
    </ul>
</section>

<section>
    <h2>3. Entitati principale</h2>
    <ul>
        <li>Utilizatori</li>
        <li>Vehicule</li>
        <li>Soferi</li>
        <li>Curse</li>
        <li>Comenzi</li>
        <li>Rapoarte</li>
        <li>Vizite site (analytics)</li>
    </ul>
</section>

<section>
    <h2>4. Procese principale</h2>
    <ul>
        <li>Autentificare / Inregistrare</li>
        <li>CRUD pe entitati (Add/Edit/Delete)</li>
        <li>Generare rapoarte PDF/CSV</li>
        <li>Statistici accesari</li>
        <li>Trimitere email prin formular de contact</li>
        <li>Integrare date externe (ex. API trasee)</li>
        <li>Terminare sesiune</li>
    </ul>
</section>

<section>
    <h2>5. Arhitectura Aplicatiei</h2>
    <p>Aplicatia urmeaza modelul clasic client-server:</p>
    <ul>
        <li><strong>Frontend:</strong> HTML, CSS, JavaScript</li>
        <li><strong>Backend:</strong> PHP</li>
        <li><strong>Baza de date:</strong> MySQL</li>
        <li><strong>Securitate:</strong> sesiuni, parole criptate, roluri</li>
    </ul>
</section>

<section>
    <h2>6. Baza de date (descriere succinta)</h2>
    <p>Baza de date include tabele relationale cu chei straine intre entitati:</p>
    <ul>
        <li><strong>utilizatori</strong>(id, nume, email, parola_hash, rol)</li>
        <li><strong>vehicule</strong>(id, nr_inmatriculare, tip, capacitate)</li>
        <li><strong>soferi</strong>(id, user_id, permis, experienta)</li>
        <li><strong>curse</strong>(id, vehicul_id, sofer_id, ruta, status)</li>
        <li><strong>comenzi</strong>(id, client_id, detalii, stare)</li>
        <li><strong>vizite</strong>(id, ip, data_acces)</li>
    </ul>
</section>

<section>
    <h2>7. UML – Schema Use Case (simplificata)</h2>
    <pre>
<section>
    <img src="diagrama.png" alt="Use Case Diagram" style="max-width:100%; border:1px solid #ccc;">
</pre>
</section>

<section>
    <h2>8. Concluzie</h2>
    <p>Documentul prezinta structura si arhitectura propusa pentru aplicatia web a unei companii de transport. Etapele urmatoare includ implementarea efectiva folosind PHP, MySQL si publicarea aplicatiei pe hosting si GitHub.</p>
</section>



</body>
