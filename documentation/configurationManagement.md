# 🧰 Configuration Management

Tutto il lavoro svolto che si tratti di documentazione o di codice viene salvato in una repository su GitHub in condivisione con tutti i membri del team e con il cliente Mario, che potrà osservare l’andamento dei lavori.

## Struttura del progetto

All’interno della repository sono presenti 4 cartelle:

- Cartella `meetings`: conterrà un file per ogni incontro svolto dal team contenente i vari punti trattati nel corso delle riunioni.
- Cartella `documentation`: conterrà i file in merito alla progettazione, a partire dal project plan. In seguito verranno aggiunti i file che tratteranno i vari punti del progetto.
- Cartella `front-end`: conterrà il codice del front-end della piattaforma, sviluppato in HTML, CSS e JavaScript implementando la libreria Bootstrap.
- Cartella `back-end`: conterrà il codice del back-end della piattaforma, sviluppato in PHP utilizzando il framework Lumen.

## Issue

Nei vari meeting settimanali vengono creati i macro task che dovranno essere sviluppati nel corso della settimana successiva. Le varie attività sono create come `issue` su GitHub, aggiungendo una breve descrizione del lavoro e la persona di riferimento che si occuperà di portarla a termine. Durante la settimana ogni membro del team è libero di creare ulteriori issue se lo ritiene necessario. 

Le issue possono trovarsi in vari stati a seconda del loro avanzamento. Per tenere traccia dello stato si utilizza una classica board Kanban suddivisa in 5 colonne: **To Do**, **Progress**, **Pull Request**, **Testing**, **Done**.

- **To do**: contiene le issue che sono state create e che devono essere sviluppate.
- **Progress**: quando il responsabile della issue inizia a lavorarci, la sposta in questa colonna. In questo modo gli altri membri del team e il cliente stesso sanno a che punto si trova lo sviluppo una determinata issue.
- **Pull Request**: quando il responsabile della issue apre una pull request per poter unire il proprio lavoro al branch `master`, la issue si trova in questo stato.
- **Testing**: una volta approvata la pull request, se è stato sviluppato del codice, l’issue passa in questo stato, altrimenti passa direttamente allo stato **Done**. Il nostro tester si occuperà di verificare che il codice sviluppato soddisfi i requisiti descritti all’interno del task. Se tutto funziona correttamente allora passa allo stato successivo (**Done**), altrimenti lo stato torna in **To Do** con un commento contenente una motivazione per tale scelta.
- **Done**: le issue che si trovano in questo stato sono state chiuse e riviste da almeno un’altra persona.

## Branch

Il branch principale è il `master`. Su questo ci sarà tutta la documentazione e tutto il codice sviluppato dal team. Tutti i file presenti in questo branch sono stati rivisti da almeno due persone: l’autore e un altro membro del team.

Quando si sviluppa una issue, ovvero quando lo stato transita da **To Do** a **Progress**, viene aperto un nuovo un branch a partire dal `master` dandogli un nome significativo. Su questo branch si svilupperanno tutte le funzionalità necessarie al fine di completare la `issue`. Una volta terminato il lavoro, viene aperta una pull request e si sposta la issue nello stato **Pull Request**. A questo punto sarà compito del team andare a revisionare le issue che sono in questo stato. In caso di dubbi si lascia un commento, in modo che l’autore della request possa risolvere eventuali problemi. Se tutto torna, si approva la pr.

Una volta che la pr ha ottenuto almeno un’approvazione da un’altra persona l’autore può unire il codice nel master e chiudere il branch. Dopo il merge nel master, se le modifiche implementate devono essere testate allora la issue passa allo stato **Testing**, altrimenti allo stato **Done**.

L’approvazione di una pr da parte di un’altra persona serve a fare in modo che il codice scritto venga revisionato da almeno un altro membro del team in modo da avere la certezza che non si introducano errori.