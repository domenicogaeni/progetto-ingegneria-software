# 🪀 Software Design @Paolo Mazzoleni

Per lo sviluppo dell’applicazione web il team si è basato sul pattern Model-view-controller (MVC), allo scopo di suddividere il codice in parti che abbiano funzionalità distinte tra loro.

I dati, la loro gestione e le interazioni con il database sono gestite dai livelli Model-Controller a lato back-end, che si occupa di gestire le query e la connessione alla base di dati.

Il livello che corrisponde alla View è l’output che presentiamo in front-end, ovvero le pagine vere e proprie che appaiono all’utente. Il contenuto, generato dal codice PHP in back-end, è restituito da un Controller che lo modella basandosi sui dati acquisiti dal database (livello Model).

Il team si è inoltre preposto di scrivere codice basandosi sui concetti di astrazione e modularità, con l’obiettivo finale di avere un programma che abbia:

- basso accoppiamento, ovvero avere moduli altamente indipendenti tra di loro; ad esempio:
    - `common coupling`: non ci sono variabili globali condivise tra i moduli;
    - `control coupling`: nessun modulo va ad utilizzare codice che appartiene a un altro modulo;
    - `external coupling`: l’unico “oggetto” esterno al codice che i moduli condividono tra di loro è il database, per il quale però esiste un modulo apposito addetto all’invio e alla ricezione dei dati; per il resto non ci sono file condivisi.
- alta coesione, ovvero avere una alta correlazione delle funzionalità presenti dentro un singolo modulo; ad esempio:
    - `procedural cohesion`: per ogni procedimento ci sono delle azioni che vengono sempre eseguite una dopo l’altra; ad esempio, quando un utente inserisce il nome di un autore per cercare i suoi libri disponibili alla vendita, il modulo opportuno andrà a leggere la stringa inserita dall’utente, poi cercherà i libri correlati nella tabella del database e infine si occuperà di stamparli secondo determinate regole grafiche.

## Pattern utilizzato

Nello sviluppo del codice, in particolare lato back-end, il team ha utilizzato il pattern “factory”. Nello specifico, è stato utilizzato per generare dati fittizi in base alle varie tabelle presenti nel database, utili nella fase di testing del codice per controllare che tutto funzioni correttamente (maggiori dettagli sul loro funzionamento nel capitolo di Software testing e manutenibilità).

Le factories che sono state realizzate sono visibili a questo link: [back-end/database/factories/](https://github.com/domenicogaeni/progetto-ingegneria-software/tree/master/back-end/database/factories).