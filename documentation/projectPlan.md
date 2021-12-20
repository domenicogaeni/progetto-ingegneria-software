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

    Per il processo di sviluppo del prototipo abbiamo optato per un approccio di tipo Agile, infatti puntiamo a rilasciare una versione di base del prodotto e integrarla mano a mano con piccoli aggiornamenti che porteranno con sé le funzionalità descritte sopra, in modo da facilitare anche le fasi di testing e debugging.
    
    Fondamentale sarà il rapporto con Mario, che sarà invitato a partecipare alle riunioni settimanali sullo stato di sviluppo del software e in particolare nella fase di progettazione.
    
    Per tenere traccia dello sviluppo delle funzionalità richieste, optiamo per l'utilizzo delle issue su Github, che saranno assegnate settimanalmente a ogni componente del gruppo in base a quello che si decide nei meeting. Mano a mano che ognuno andrà a completare i punti che gli sono stati assegnati, le issue verranno chiuse e i documenti pubblicati sulla piattaforma.

3.  **Organizzazione del progetto** @Domenico Gaeni

    Le persone coinvolte nel progetto sono quattro: il cliente Mario, e il team di progettisti/sviluppatori, formato da Domenico, Fabio e Paolo. Di seguito saranno descritti i loro ruoli e le loro mansioni.

    L'intera documentazione riguardante il progetto sarà riportata e tracciata su GitHub. In particolare, il team si incontra settimanalmente per analizzare il lavoro svolto dall'ultimo meet e pianificare le attività future, tracciando i task come issue su GitHub in modo che ogni persona del team sia al corrente di cosa stiano facendo gli altri.
    Al repository GitHub inoltre avrà accesso anche il nostro cliente Mario che interagirà con noi e si assicurerà lui stesso che lo sviluppo vada come previsto.

4.  **Standards, guidelines, procedures** @Fabio Palazzi

5.  **Management activities** @Paolo Mazzoleni

    Abbiamo deciso di organizzarci secondo la filosofia dello "swat team" (Skilled Workers with Avdanced Tools): gli incontri saranno settimanali e relativamente brevi, della durata di un'ora circa. Durante gli stessi potranno essere effettuate sessioni di brainstorming per condividere idee e risolvere problemi.
    Il team di sviluppo si pone l'obiettivo di incontrarsi settimanalmente per aggiornarsi sullo stato dei lavori. In base alle esigenze si decide se effettuare la riunione virtualmente tramite la piattaforma Google Meet o se è necessario incontrarsi e svolgerla di persona.
    
    Ad ogni incontro, i membri del gruppo espongono brevemente quali sono stati i punti portati avanti e quali sono state le problematiche incontrate sul proprio cammino. Mano a mano che si procede nell'esposizione, si aggiorna un documento che tiene traccia dei lavori svolti fino a quel momento. Alla fine di ogni meeting verrà scritta una breve relazione in merito a quanto discusso.
    
    Alla fine del meeting ci si accorda su quali sono i punti da portare avanti; sarà il project manager ad assegnare a ciascun membro del gruppo, se stesso compreso, i compiti che dovranno essere eseguiti prima del prossimo incontro.

6.  **Rischi** @Domenico Gaeni

    La durata del lavoro è di circa 75 giorni e l'obiettivo è quello di arrivare al termine con tutta la documentazione e il prototipo definito insieme a Mario. In particolare ci sono due scadenze da rispettare: il 10 gennaio per la consegna della documentazione e il 31 gennaio per la consegna del codice.

    Il rischio principale del progetto è che il nostro cliente non ci paghi la cifra pattuita insieme e di conseguenza di aver lavorato inutilmente. Per ridurre questo rischio abbiamo deciso insieme al cliente di suddividere il pagamento in due rate, i dettagli sono definiti nel punto 12 del presente documento.
    Facendo due tranches del pagamento abbassiamo il rischio in quanto se il cliente non ci paga la prima parte del lavoro possiamo fermare lo sviluppo del prototipo risparmiando così ore di lavoro.

7.  **Staffing** @Fabio Palazzi

8.  **Methods and techniques** @Fabio Palazzi

9.  **Quality assurance** @Paolo Mazzoleni

    Il team punta a sviluppare un software che rispetti i parametri di qualità indicati dal modello di McCall:
    
    - Correttezza
    - Affidabilità
    - Robustezza
    - Integrità
    - Usabilità
    
    Per garantire la sicurezza utilizziamo librerie moderne, aggiornate frequentemente e poco inclini ad avere vulnerabilità.
    
    Inoltre dividiamo il lato back-end da quello front-end, cosicché in futuro il cliente potrà assumere personale separato per lo sviluppo delle due parti.
    
    Puntiamo a sviluppare un software che, oltre a rispettare i quality assurance, sia anche sicuro:
    
    - verifica dell'indirizzo email: un utente, per completare il processo di registrazione, deve confermare i propri dati cliccando su un link apposito ricevuto via mail;
    - doppia autenticazione tramite OTP: un utente, per poter accedere al proprio account, potrà richiedere che ogni accesso debba essere confermato tramite l'inserimento un codice univoco a tempo ricevuto per messaggio SMS.

10. **Work packages** @Domenico Gaeni

    Il prototipo sviluppato sarà costituito da due parti principali, una front-end e una back-end. In questo modo tutta la parte relativa all'interfaccia grafica sarà presente nel codice del front-end e invece la parte di gestione dei dati e di interfaccia con il DB sarà gestita all'interno del back-end.

    Il back-end è sviluppato con il framework `Lumen` che si basa a sua volta sul framework `Laravel` che implementa il pattern `MVC` (Model-View-Controller) anche se in verità la parte di view sarà implementata all'interno del front-end.

    Nel back-end ci saranno quindi delle classi (_model_) che modelleranno le varie tabelle presenti nel DB e delle classi (_controller_) che manipolano i modelli a seconda del comportamento desiderato. Quindi, per esempio, in fase di registrazione di un nuovo utente ci saranno due classi `UserController` e `User`. Un metodo della classe `UserController` si occuperà di ricevere i dati dal front-end, di validarli a seconda del tipo e di creare una nuova istanza del modello `User`.
    Inoltre il mondo PHP è diverso per quanto riguarda la gestione dei packages, infatti in questo linguaggio i modelli saranno presenti in una apposita cartella sotto il nome di `Model`, mentre i controller sotto la cartella `Controller`

11. **Resources** @Fabio Palazzi

12. **Budget & schedule** @Domenico Gaeni

    La durata del progetto è di 75 giorni e durante questo periodo il team si concentrerà fondamentalmente su due grandi fasi, la prima di _progettazione_ e la seconda di _sviluppo_.
    Il costo totale del lavoro sarà circa di 11.700€. Il prezzo è calcolato togliendo dal totale circa 10 giorni festivi (week-end e festività), quindi per un totale di 65 giorni. Il team è formato da 3 persone che lavorano part-time per un totale di 4 ore giornaliere. Ogni ora è pagata 15€ lordi.

    Il costo totale è quindi definito dalla seguente espressione:
    `65 giorni * 3 persone * 4 ore * 15 €/ora = 11.700€`

    Insieme a Mario si è scelto di fare due trenches di pagamento, il 60% (pari a 7.020€) al termine della progettazione e il restante 40% (4.680€) a conclusione dei lavori. Si è scelto di dare più importanza alla documentazione in quanto verrà progettato l'intero sistema in tutte le sue funzionalità e di dare invece meno importanza allo sviluppo in quanto verrà sviluppato un prototipo con solo alcune funzionalità.
    La consegna stimata della prima parte è attorno al 10 gennaio, mentre la data di fine lavori è attorno al 1 febbraio.

13. **Changes** @Paolo Mazzoleni

    Oltre alle feature base incluse inizialmente nel prodotto e descritte al punto uno di questo documento, l'obiettivo sarà quello di mettere le basi per ulteriori funzionalità allo scopo di fornire un servizio più completo, in accordo con Mario. Queste verranno inserite nelle successive versioni del software e includeranno:
    
    - un carrello, nel quale i clienti potranno inserire prodotti da acquistare ed effettuare un unico pagamento, a differenza di quello che avviene nella versione base del software nella quale è necessario effettuare un pagamento separato per ogni prodotto;
    - liste desideri, nelle quali i clienti potranno inserire prodotti per eventuali acquisti futuri, con la possibilità di crearne più di una e ad ognuna assegnare un nome;
    - una dashboard personalizzata per ogni cliente, che varierà in base all'autore/genere di libri acquistati in precedenza;
    - la possibilità di salvare un metodo di pagamento (carta di debito/credito/prepagata) per poterla utilizzare negli acquisti futuri senza la necessità di inserirla ogni volta;
    - la possibilità di acquistare buoni regalo con credito spendibile sul sito.

14. **Delivery** @Fabio Palazzi