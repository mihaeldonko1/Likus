const fs = require('fs');
const xml2js = require('xml2js');
const mysql = require('mysql');

// Create a MySQL connection
const connection = mysql.createConnection({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'strapi',
  charset: 'utf8mb4'
});

// Establish the MySQL connection
connection.connect(err => {
  if (err) {
    console.error('Error connecting to MySQL:', err);
    return;
  }

  console.log('Connected to MySQL.');

  // Read the XML file
  fs.readFile('grid_Maticna_knjiga (1).xml', 'utf-8', (err, data) => {
    if (err) {
      console.error('Error reading XML file:', err);
      return;
    }

    // Parse XML to JSON
    xml2js.parseString(data, (err, result) => {
      if (err) {
        console.error('Error parsing XML:', err);
        return;
      }

      const entries = result.root.grid_Maticna_knjiga;

      // Iterate through the entries and insert them into the database
      (async () => {
        for (const entry of entries) {
          const zap = entry.Zap___t_[0];
          const ime = entry.Ime[0];
          const priimek = entry.Priimek[0];
          const spol = entry.Spol[0];
          const naslov = entry.Naslov[0];
          const postnaTevilka = entry['Po__tna___tevilka'][0] || '';
          const posta = entry['Po__ta'][0];
          const drzava = entry['Dr__ava'][0];
          const telefon = entry['Telefon'][0] || '';
          const gsm = entry['GSM'][0] || '';
          const email = entry['Email'][0] || '';
          const rojstniDan = formatDate(entry['Rojstni_dan'][0]);
          const datumVstopa = formatDate(entry['Datum_vstopa'][0]);
          const datumIzstopa = formatDate(entry['Datum_izstopa'][0]);
          const razlogIzstopa = entry['Razlog_izstopa'][0];
          const preverjenoNaTerenu = entry['Preverjeno_Na_Terenu'][0];
          const starost = entry['Starost'][0] || 0;

          // Prepare the SQL query
               // Prepare the SQL query
               const query = `INSERT INTO clanis (id, ime, priimek, spol, naslov, postna_stevilka, posta, drzava, telefon, gsm, email, rojstni_dan, datum_vstopa, datum_izstopa, razlog_izstopa, preverjeno_na_terenu) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)`;
               const values = [zap, ime, priimek, spol, naslov, postnaTevilka, posta, drzava, telefon, gsm, email, rojstniDan, datumVstopa, datumIzstopa, razlogIzstopa, preverjenoNaTerenu];
     
               // Execute the query
               try {
                 await executeQuery(query, values);
                 console.log('Data inserted successfully.');
               } catch (err) {
                 console.error('Error inserting data:', err);
               }
             }
           })();
         });
       });
     });
     
     function formatDate(dateString) {
       if (!dateString) {
         return null;
       }
     
       const dateParts = dateString.split('.');
       const formattedDate = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`;
       return formattedDate;
     }
     
     function executeQuery(query, values) {
       return new Promise((resolve, reject) => {
         connection.query(query, values, (err, result) => {
           if (err) {
             reject(err);
           } else {
             resolve(result);
           }
         });
       });
     }
     
