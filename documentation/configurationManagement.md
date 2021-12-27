# 🧰 Configuration Management

Tutto il lavoro svolto sia che si tratti di documentazione che di codice viene salvato in un repository su GitHub in condivisione con tutti i membri del team e il cliente Mario, che potrà osservare l'andamento dei lavori.

## Struttura del progetto

All’interno del repository sono presenti 4 cartelle:

- Cartella `meetings`, conterrà un file per ogni incontro svolto dal team contenente i vari punti trattati nel corso della riunione;
- Cartella `documentation`, conterrà i vari file in merito alla progettazione, a partire dal project plan. In seguito verranno aggiunti i file che tratterranno i vari punti del progetto;
- Cartella `front-end`, conterrà il codice del front-end della piattaforma, sviluppato in HTML, CSS, JavaScript implementando la libreria Bootstrap;
- Cartella `back-end`, conterrà il codice del back-end della piattaforma, sviluppato in PHP utilizzando il framework Lumen;

## Issue

Durante i vari meeting settimanali vengono creati i macro task che dovranno essere sviluppati nel corso della settimana successiva. Le varie attività sono create come `issue` su GitHub, aggiungendo una breve descrizione del lavoro e la persona di riferimento che si occuperà di portarla a termine.
Se nel corso della settimana un membro del team ha la necessità di creare altre issue è libero di farlo.

Le issue possono trovarsi in vari stati a seconda del loro avanzamento. Per tenere traccia dello stato si utilizza una classica board Kanban suddivisa in 5 colonne: **To Do**, **Progress**, **Pull Request**, **Testing**, **Done**.

- **To do**: contiene le issue che sono state create e che devono essere sviluppate;
- **Progress**: quando il responsabile della issue inizia a lavorarci, la sposta in questa colonna. In questo modo gli altri membri del team e il cliente stesso sanno a che punto si trova lo sviluppo una determinata issue;
- **Pull Request**: quando il responsabile della issue apre una pull request per poter mergiare il proprio lavoro, la issue si trova in questo stato.
- **Testing**: Una volta approvata la pull request, se è stato sviluppato del codice, l’issue passa in questo stato altrimenti passa direttamente allo stato **Done**.
  Il nostro tester si occuperà di verificare che il codice sviluppato soddisfi i requisiti descritti all’interno del task. Se va tutto bene allora passa allo stato successivo (**Done**), altrimenti lo stato torna in **To Do** con un commento sul perchè di tale scelta.
- **Done**: le issue che si trovano in questo stato sono state chiuse e riviste da almeno un’altra persona.

## Branch

Il branch principale è il `master`. Su questo branch ci sarà tutta la documentazione e tutto il codice sviluppato dal team. Tutti i file presenti in questo branch sono stati rivisti da almeno 2 persone: l’autore e un altro membro del team.

Quando si sviluppa una issue, quindi quando lo stato transita da **To Do** a **Progress**, viene staccato un branch da `master` dandogli un nome significativo. Su questo branch si svilupperà tutte le cose necessarie al fine di completare la `issue`. Una volta terminato il lavoro, viene aperta una pull request e si sposta la issue nello stato **Pull Request**.
A questo punto sarà compito del team andare a revisionare le issue che sono nello stato **Pull Request**. Se al team non torna qualcosa si lascia un commento, in modo che l’autore della pr possa risolvere eventuali problemi. Se torna tutto, si approva la pr.

Una volta che la pr ha ottenuto almeno un’approvazione da un’altra persona l’autore può mergiare il codice nel branch master e chiudere il branch.
Dopo il merge in master se le modifiche implementate devono essere testate allora la issue passa allo stato **Testing**, altrimenti allo stato **Done**.

L’approvazione di una pr da un’altra persona serve per fare in modo che il codice che viene scritto sia revisionato da almeno un altro membro del team in modo da avere la certezza che non si introducano errori e/o codice che non segua un certo standard.
