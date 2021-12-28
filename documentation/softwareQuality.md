# 💯 Software Quality @Paolo Mazzoleni

La startup si è prefissata l’obiettivo di sviluppare un software che rispetti i parametri e gli attributi di qualità definiti da McCall-Richards-Walters nel documento da loro redatto nel 1977, di seguito elencati e suddivisi in categorie come indicato dagli autori.

## Parametri riguardanti l’operatività del software

- Correttezza - Il prodotto software da noi realizzato soddisfa i requisiti e le specifiche indicate dal cliente. Le funzionalità da noi non sviluppate ma solo progettate saranno portate avanti dal team di sviluppo che Mario assumerà dopo che avremo fornito il prototipo.
- Affidabilità - Il software è affidabile in quanto revisionato a livello di team e sottoposto a una lunga fase di testing prima del rilascio.
- Efficienza - Le risorse utilizzate dal prodotto sono limitate in quanto si tratta di un’applicazione web e molte delle operazioni sono effettuate lato back-end dal server. È quindi comunque necessaria una connessione internet e un browser per accedere ai servizi del software da noi sviluppato.
- Integrità - Il prodotto che sviluppiamo è sicuro:
    - Le password degli utenti sono crittografate nel database secondo il *Secure Hash Algorithm SHA-256*, quindi non visibili chiaramente anche a chi ha accesso al db.
    - All’atto dell’inserimento dei dati durante il processo di registrazione, per prevenire tentativi con indirizzi email errati e/o non di proprietà di chi effettivamente cerca di registrarsi, viene inviato un link di verifica alla mail specificata per completare il processo di registrazione: l’account non verrà attivato e non potrà essere utilizzato fino all’apertura del link.
    - Sarà possibile per un utente attivare la “verifica in due passaggi” per l’accesso all’account. Sarà sufficiente registrare sul sito web il proprio numero di telefono: dopo aver inserito indirizzo email e password, per poter proseguire con il log in si riceverà tramite SMS un codice OTP da sei cifre da inserire nell’apposito campo.
    - L’utilizzo del protocollo HTTPS garantisce che lo scambio di dati tra client e server sia crittografato e quindi al sicuro da eventuali tentativi esterni di accesso ai dati.
- Usabilità - Il prodotto è semplice da utilizzare, infatti non sono richieste particolari abilità per poterne usufruire. L’uso dei servizi è facilitato su tutti i tipi di piattaforma grazie all’utilizzo della libreria Bootstrap che permette di avere componenti grafici semplici e facili da utilizzare.
    
    I requisiti “base” includono:
    
    - Avere una connessione internet.
    - Avere un indirizzo email di proprietà per il processo di registrazione.
    - Sapere come effettuare un pagamento online.

## Parametri riguardanti la revisione del software

- Manutenibilità - La fase di individuazione gli errori è semplificata dalla nostra scelta di separare i lati front-end, sviluppato in HTML 5/CSS/javascript, e back-end, sviluppato in PHP. Il processo è inoltre facilitato poiché si ha la parte grafica separata dalla parte di gestione dei dati: è semplice fare manutenzione avendo persone specializzate in ambiti differenti.
- Testabilità - Tutte le feature incluse nel prototipo sviluppato sono testabili (tramite test manuali e test automatici) prima del rilascio del software al pubblico. Delle funzionalità che saranno invece da noi solo progettate si occuperanno in futuro i dipendenti della società del cliente: saranno loro a svilupparle e a effettuare la fase di testing.
- Flessibilità - Come per la manutenibilità, anche il processo di modifica, adattamento e perfezionamento del software è facilitata dalla scelta di separare i lati front e back-end.

## Parametri riguardanti la transizione verso un nuovo ambiente

- Portabilità - È possibile utilizzare i servizi offerti dal nostro prodotto da qualsiasi dispositivo dotato di un browser e di una connessione internet. Dal punto di vista grafico invece, grazie all’utilizzo della libreria Bootstrap, il sito web sarà responsive, ovvero in grado di adattarsi a qualunque schermo su cui sarà aperto.
- Riusabilità - Per la parte grafica utilizziamo un template della libreria Bootstrap che il team aveva implementato per delle applicazioni sviluppate in precedenza. Il template sarà riutilizzabile anche per future applicazioni web in quanto si tratta di una base grafica.
- Interoperabilità - Nel futuro il nostro prodotto software potrà essere integrato con altri servizi in quanto sviluppiamo in modo separato front-end e back-end: il lato back-end potrà fornire delle API pubbliche utilizzabili da altri utenti. La scelta in tal senso sarà fatta dai dipendenti della nuova società di Mario.
