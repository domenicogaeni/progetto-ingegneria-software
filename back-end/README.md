# API - Documentazione

## Introduzione

Le API sono sviluppate in **PHP 8.0** utilizzando come framework **Lumen 8** ([documentazione](https://lumen.laravel.com/docs/8.x)).

Il progetto è stato sviluppando con **Docker** ([documentazione](https://docs.docker.com/)).

## Prerequisiti

-   [Docker](https://www.docker.com/) (da installare sulla propria macchina seguendo la documentazione ufficiale a seconda del proprio sistema operativo).
    Con Docker è possibile i container per poter sviluppare senza troppi problemi in locale.

Non sono richiesti altri prerequisiti visto che il codice girerà all'interno dei singoli container.

## Setup dell'ambiente in locale

Come prima cosa dopo aver clonato la repo in locale eseguire i seguenti step:

-   Creare un file `.env` a partire dal file `.env.example` (e.g. `cp .env.example .env`) e compilare con i valori segreti nelle variabili vuote.
-   Avviare i servizi con Docker: `docker-compose up -d`. In questo modo vengono avviati i container, in particolare `lumen` e `database` (descritti in seguito). Eseguendo questo comando vengono create in automatico le tabelle su container `database` a partire dalle migrazioni.

## Infrastruttura in locale

I container utilizzati per eseguire correttamente il progetto in locale sono descritti nel file `docker-compose.yml`.

Di seguito vengono descritti brevemente i singoli servizi:

-   `database`: si basa su un immagine `mysql 8`, vengono specificate le credenziali di accesso al db. Esse (`DB_PASSWORD` e `DB_DATABASE`) sono specificate nel `.env` e possono essere modificate a piacere.
-   `lumen`: si basa su un'immagine `apache` con PHP 8.0 customizzata. La ricetta del container si può trovare nella cartella `environments`, all'interno della quale sono presenti 3 sottocartelle, ognuna contenente l'immagine Docker utilizzata a seconda del contesto:
    -   `base`: ricetta base che viene estesa da `dev` e `prod`.
    -   `dev`: ricetta utilizzata per lo sviluppo in locale. Estende l'immagine `base` e ci aggiunge le estensioni per `Xdebug` (per il debug di PHP). Viene utilizzata all'interno di `docker-compose.yml`.
    -   `prod`: ricetta utilizzata per l'ambiente di produzione. Estende l'immagine `base` ed effettua alcune operazione di ottimizzazione, come per esempio cancellare i file e le cartelle inutili, copiare il `.env` con tutte le credenziali per l'accesso ai vari servizi, ed infine eseguire le migrazioni che andranno ad allineare il database di produzione con le nuove modifiche effettuate.
        Su questo container viene eseguito il codice che scriviamo nella root del progetto, quindi le API che sviluppiamo "vivono" all'interno del container apache. Esse saranno raggiungibili in locale all'indirizzo: `localhost:{PHP_HOST_PORT}` (dove `PHP_HOST_PORT` è una variabile definita nel file `.env`, di default sarà 80). All'avvio del container vengono eseguiti alcuni comandi, quali:
    -   `composer install`: scarica le dipendenze del progetto descritte nel `composer.json`
    -   `php artisan migrate --force`: esegue le migrazioni in modo forzato. Questo significa che ogni volta che vengono avviati i container con `docker-compose up -d`, questo comando distruggerà tutte le tabelle e tutti i dati presenti nel DB in locale e li ricreerà nuovamente. Chiaramente se il container viene lasciato attivo, questo comando viene eseguito solo la prima volta. In alternativa si può omettere `--force` e verranno eseguite solo le migrazioni che non sono state mai eseguite. Questo comando può essere modificato a seconda delle esigenze.
    -   `apache2-foreground`: esegue il sevizio di apache2 in foreground in modo che il container rimanga attivo, altrimenti esso si spegnerebbe nel momento in cui non c'è un processo attivo in esecuzione.

## Deploy in produzione

Ogni volta che viene fatto un push sul branch master viene eseguito il deploy in produzione, eseguendo la Github Action presente nella repo descritta nel file `.github/workflows/deploy.yml`.

Molto semplicemente all'interno della Github Action viene eseguito il checkout del codice, viene buildata l'immagine Docker di produzione, descritta all'interno del file `./environments/prod/Dockerfile` e viene caricata su Heroku. Per eseguire l'upload del codice vengono passate le credenziali di Heroku e le varie informazioni del DB che sono presenti come secrets su Github.

Il database utilizzato è un PostgreSQL ed è incluso nel piano gratuito scelto per il progetto.

Il link pubblico per le api è raggiungibile a questo url: https://ingegneria-software.herokuapp.com/public/

Un domani si possono scegliere soluzioni più avanzate per l'ambiente di produzione, quale per esempio AWS o Google Cloud con i loro servizi. Utilizzando un'immagine Docker dove è presente il codice di produzione, il processo di deploy del codice è molto semplice sulle varie infrastrutture, infatti l'unico requisito che serve è che sia presente il Docker Engine sulla macchina.
