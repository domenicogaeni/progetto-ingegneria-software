# Project plan

## Premessa

Immaginiamo che il testo del problema, contenente i requisiti scritti in linguaggio naturale, sia una richiesta da parte di un ipotetico cliente indicato di seguito come Mario Rossi.

Mario ha idea di aprire una startup il cui prodotto sarà il sistema descritto nel testo ed è alla ricerca di possibili investitori, in quanto lui stesso non ha i fondi sufficienti per costituire la società e assumere degli sviluppatori. Gli investitori vogliono però vedere un prototipo di come sarà l'intero sistema a lavori finiti.

Mario si vuole quindi affidare alla nostra azienda costituita da Domenico, Fabio e Paolo al fine di progettare l'intero sistema e di sviluppare una prima versione, in modo che possa poi andare a presentare il prototipo a possibili investitori per ricevere un finanziamento.

La nostra azienda è una società di consulenza che ha solo noi tre come liberi professionisti, infatti ognuno di noi ha la propria partita IVA con regime forfettario. La nostra società emetterà fattura a Mario e noi emetteremo in seguito fattura verso la nostra società.

Inoltre, Mario ha la necessità di avere la documentazione riguardante il prodotto in quanto, alla fine della collaborazione, assumerà i propri sviluppatori. Sarà quindi la nuova società di Mario ad occuparsi di finire e manutenere l'intero sistema.

1.  **Introduzione**: @Domenico Gaeni

    Dopo un'attenta analisi dei requisiti scritti in linguaggio naturale con il nostro cliente Mario, di seguito saranno riportati i passi al fine di realizzare una prima versione del sistema richiesto.
    Alla progettazione dell'intero sistema e allo sviluppo del primo prototipo ci lavoreranno tre persone: Domenico, Fabio e Paolo; di seguito saranno descritti i ruoli specifici per ognuno.

    Dopo un primo incontro con il nostro cliente si è deciso insieme di sviluppare fisicamente un prototipo che implementi le seguenti funzionalità:

    - registrazione di nuovi utenti, senza la verifica dell'indirizzo email e senza l'implementazione della doppia autenticazione;
    - possibilità per un venditore di inserire un nuovo libro indicando gli attributi descritti nel testo;
    - possibilità per un acquirente di consultare il catalogo dei libri disponibili tramite ricerca con parole chiavi quali titolo, autore, ISBN, genere;
    - possibilità per un utente di acquistare un libro, specificando l'indirizzo di consegna senza effettuare il pagamento: in questa versione infatti non sono gestiti i pagamenti, quindi l'utente per poter acquistare un libro dovrà specificare solo un indirizzo di spedizione;
    - possibilità per un utente di consultare il proprio storico degli acquisti;
    - possibilità per un utente di recensire un prodotto che ha acquistato e il suo venditore.

    In particolare, insieme a Mario si è scelto di non implementare fisicamente l'integrazione con il servizio che manda l'email, il servizio che manda il codice OTP per la doppia autenticazione e il servizio per gestire i pagamenti, in quanto comportano dei costi elevati che il nostro cliente in almeno in questa prima versione non può finanziare.

    In fase di progettazione dovrà comunque essere studiato l'intero sistema con tutte le integrazioni e le funzionalità descritte in precedenza.

    Mario ha la necessità di avere una prima versione del prodotto entro la fine di gennaio 2022, quindi alla stesura di questo documento si hanno a disposizione circa 75 giorni.

    Questi 75 giorni di tempo saranno suddivisi in due parti: una prima parte sarà dedicata completamente alla stesura della progettazione dell'intero sistema, mentre nella seconda verrà sviluppato concretamente il prototipo di cui sopra.

    Ci saranno degli incontri intermedi con il cliente durante la fase di progettazione del sistema (prima di procedere con lo sviluppo), in modo da mantenerlo aggiornato e ricevere un suo feedback.

    Entro la fine di Gennaio il prodotto da consegnare a Mario sarà una piattaforma web che implementa le funzionalità minime descritte in precedenza.

2.  **Modello di processo** @Paolo Mazzoleni

3.  **Organizzazione del progetto** @Domenico Gaeni

    Le persone coinvolte nel progetto sono quattro: il cliente Mario, e il team di progettisti/sviluppatori, formato da Domenico, Fabio e Paolo. Di seguito saranno descritti i loro ruoli e le loro mansioni.

    L'intera documentazione riguardante il progetto sarà riportata e tracciata su GitHub. In particolare, il team si incontra settimanalmente per analizzare il lavoro svolto dall'ultimo meet e pianificare le attività future, tracciando i task come issue su GitHub in modo che ogni persona del team sia al corrente di cosa stiano facendo gli altri.
    Al repository GitHub inoltre avrà accesso anche il nostro cliente Mario che interagirà con noi e si assicurerà lui stesso che lo sviluppo vada come previsto.

4.  **Standards, guidelines, procedures** @Fabio Palazzi

5.  **Management activities** @Paolo Mazzoleni

6.  **Rischi** @Domenico Gaeni

    La durata del lavoro è di circa 75 giorni e l'obiettivo è quello di arrivare al termine con tutta la documentazione e il prototipo definito insieme a Mario. In particolare ci sono due scadenze da rispettare: il 10 gennaio per la consegna della documentazione e il 31 gennaio per la consegna del codice.

    Il rischio principale del progetto è che il nostro cliente non ci paghi la cifra pattuita insieme e di conseguenza di aver lavorato inutilmente. Per ridurre questo rischio abbiamo deciso insieme al cliente di suddividere il pagamento in due rate, i dettagli sono definiti nel punto 12 del presente documento.
    Facendo due tranches del pagamento abbassiamo il rischio in quanto se il cliente non ci paga la prima parte del lavoro possiamo fermare lo sviluppo del prototipo risparmiando così ore di lavoro.

7.  **Staffing** @Fabio Palazzi

8.  **Methods and techniques** @Fabio Palazzi

9.  **Quality assurance** @Paolo Mazzoleni

10. **Work packages** @Domenico Gaeni

    Il prototipo sviluppato sarà costituito da due parti principali, una front-end e una back-end. In questo modo tutta la parte relativa all'interfaccia grafica sarà presente nel codice del front-end e invece la parte di gestione dei dati e di interfaccia con il DB sarà gestita all'interno del back-end.

    Il back-end è sviluppato con il framework `Lumen` che si basa a sua volta sul framework `Laravel` che implementa il pattern `MVC` (Model-View-Controller) anche se in verità la parte di view sarà implementata all'interno del front-end.

    Nel back-end ci saranno quindi delle classi (_model_) che modelleranno le varie tabelle presenti nel DB e delle classi (_controller_) che manipolano i modelli a seconda del comportamento desiderato. Quindi, per esempio, in fase di registrazione di un nuovo utente ci saranno due classi `UserController` e `User`. Un metodo della classe `UserController` si occuperà di ricevere i dati dal front-end, di validarli a seconda del tipo e di creare una nuova istanza del modello `User`.
    Inoltre il mondo PHP è diverso per quanto riguarda la gestione dei packages, infatti in questo linguaggio i modelli saranno presenti in una apposita cartella sotto il nome di `Model`, mentre i controller sotto la cartella `Controller`

11. **Resources** @Fabio Palazzi

12. **Budget & schedule** @Domenico Gaeni

13. **Changes** @Paolo Mazzoleni

14. **Delivery** @Fabio Palazzi
