# 🏛 Software architecture @Fabio Palazzi

L’architettura del nostro sistema è un’architettura client server basata sul pattern MVC (model - view - controller). Abbiamo quindi il front-end che ricopre il ruolo di view in quanto mostra risultati (statici e dinamici che siano) all’utente. Il back-end ricopre invece sia il ruolo di model, in quanto si occupa di astrarre e manipolare la suite di dati attraverso un database, che di controller, in quanto attraverso librerie di routing accetta richieste http (GET, POST, PUT, DELETE anche autenticate) e, tramite un iterazione con il database, ritorna i risultati all view.

In questo modo abbiamo voluto creare un’architettura a servizi in cui ogni tipo di richiesta http accettata dal controller può essere vista come un servizio a sé e quindi eseguibile in una macchina diversa. Nel nostro caso, abbiamo deciso di integrare questa struttura in modo da migliorare la leggibilità e soprattutto la manutenibilità del codice. Ma è bene sottolineare che al momento la struttura del backend è più monolitica, infatti tutti i servizi vengono eseguiti sulla stessa macchina. Un ulteriore vantaggio nell'aver predisposto i servizi è che minimizziamo l’accoppiamento e nascondiamo la logica interna.

L’architettura è sicura: per accedere alla piattaforma viene creato all’atto dell’autenticazione un token (`Bearer`) che viene salvato sia nel nostro database che nella memoria locale `localStorage` gestita dal framework _jquery._ Questo token dovrà quindi essere passato ad ogni chiamata http formulata dopo essersi loggati, introducendo un doppio livello di sicurezza:

- il primo è a livello `view` (_front-end_): tramite codice _jquery_ verifichiamo che il cliente sia correttamente autenticato verificando l’esistenza del token nel _localStorage_ e passandolo al backend per controllarne la validità. Tuttavia, il codice _jquery_ è eseguito localmente e quindi è vulnerabile in quanto l’utente potrebbe manipolare tutto il codice, cancellando ad esempio lo script che controlla la corretta autenticazione dell’utente loggato.
- il secondo è a livello `controller-model` (back*-*end) per risolvere il problema sopra citato: lato server andiamo a controllare che ogni richiesta http autenticata abbia nel campo authorization, contenuto nella header, un token bearer valido. In caso affermativo, viene ritornato un messaggio con uno stato 200 e il contenuto della richiesta, se no viene ritornato un mesaggio con stato 401 ovvero _non autorizzato._

La view è stata realizzata utilizzando `HTML`, la libreria `BOOTSTRAP` e il framework `jQuery` per gestire le richieste asincrone da inviare al backend.

Il back-end è stato realizzato utilizzando un database MySql e il Framework Laravel con PHP 8 ed è stato sviluppato utilizzando Docker, di seguito sono descritti i dettagli dell’infrastruttura in locale e in produzione.

## Infrastruttura in locale

I container utilizzati per eseguire correttamente il progetto in locale sono descritti nel file `docker-compose.yml`.

Di seguito vengono descritti brevemente i singoli servizi:

- `database`: si basa su un immagine `mysql 8`, vengono specificate le credenziali di accesso al db. Esse (`DB_PASSWORD` e `DB_DATABASE`) sono specificate nel `.env` e possono essere modificate a piacere.
- `lumen`: si basa su un'immagine `apache` con PHP 8.0 customizzata. La ricetta del container si può trovare nella cartella `environments`, all'interno della quale sono presenti 3 sottocartelle, ognuna contenente l'immagine Docker utilizzata a seconda del contesto:
  - `base`: ricetta base che viene estesa da `dev` e `prod`.
  - `dev`: ricetta utilizzata per lo sviluppo in locale. Estende l'immagine `base` e ci aggiunge le estensioni per `Xdebug` (per il debug di PHP). Viene utilizzata all'interno di `docker-compose.yml`.
  - `prod`: ricetta utilizzata per l'ambiente di produzione. Estende l'immagine `base` ed effettua alcune operazione di ottimizzazione, come per esempio cancellare i file e le cartelle inutili, copiare il `.env` con tutte le credenziali per l'accesso ai vari servizi, ed infine eseguire le migrazioni che andranno ad allineare il database di produzione con le nuove modifiche effettuate.
    Su questo container viene eseguito il codice che scriviamo nella root del progetto, quindi le API che sviluppiamo "vivono" all'interno del container apache. Esse saranno raggiungibili in locale all'indirizzo: `localhost:{PHP_HOST_PORT}` (dove `PHP_HOST_PORT` è una variabile definita nel file `.env`, di default sarà 80). All'avvio del container vengono eseguiti alcuni comandi, quali:
  - `composer install`: scarica le dipendenze del progetto descritte nel `composer.json`
  - `php artisan migrate --force`: esegue le migrazioni in modo forzato. Questo significa che ogni volta che vengono avviati i container con `docker-compose up -d`, questo comando distruggerà tutte le tabelle e tutti i dati presenti nel DB in locale e li ricreerà nuovamente. Chiaramente se il container viene lasciato attivo, questo comando viene eseguito solo la prima volta. In alternativa si può omettere `-force` e verranno eseguite solo le migrazioni che non sono state mai eseguite. Questo comando può essere modificato a seconda delle esigenze.
  - `apache2-foreground`: esegue il sevizio di apache2 in foreground in modo che il container rimanga attivo, altrimenti esso si spegnerebbe nel momento in cui non c'è un processo attivo in esecuzione.

## Deploy in produzione

Ogni volta che viene fatto un push sul branch master viene eseguito il deploy in produzione, eseguendo la Github Action presente nella repo descritta nel file `.github/workflows/deploy.yml`.

Molto semplicemente all'interno della Github Action viene eseguito il checkout del codice, viene buildata l'immagine Docker di produzione, descritta all'interno del file `./environments/prod/Dockerfile` e viene caricata su Heroku. Per eseguire l'upload del codice vengono passate le credenziali di Heroku e le varie informazioni del DB che sono presenti come secrets su Github.

Il database utilizzato è un PostgreSQL ed è incluso nel piano gratuito scelto per il progetto.

Il link pubblico per le api è raggiungibile a questo url: [https://ingegneria-software.herokuapp.com/public/](https://ingegneria-software.herokuapp.com/public/)

Un domani si possono scegliere soluzioni più avanzate per l'ambiente di produzione, quale per esempio AWS o Google Cloud con i loro servizi. Utilizzando un'immagine Docker dove è presente il codice di produzione, il processo di deploy del codice è molto semplice sulle varie infrastrutture, infatti l'unico requisito che serve è che sia presente il Docker Engine sulla macchina.
