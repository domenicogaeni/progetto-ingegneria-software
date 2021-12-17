# Project plan

1.  **Introduzione**: @Domenico Gaeni

2.  **Modello di processo** @Paolo Mazzoleni

3.  **Organizzazione del progetto** @Domenico Gaeni

4.  **Standards, guidelines, procedures** @Fabio Palazzi

    Il team ha deciso di sviluppare un'applicazione web per implementare il sistema descritto. L'applicazione sarà suddivisa in due parti: 
    
    - **front-end** - si occupa dell'interfaccia grafica e dell'interazione con il back-end;
    - **back-end** - mette a disposizione delle API che verranno utilizzate dal front-end.
    
    Il ***front-end*** verrà sviluppato utilizzando HTML 5 / CSS, in particolare utilizzando la libreria Bootstrap ([documentazione](https://getbootstrap.com/)) e la libreria di javascript JQuery ([documentazione](https://api.jquery.com/)) per gestire le chiamate (API) al back-end e manipolare i dati da mostrare e salvare.
    
    Il ***back-end*** invece è implementato utilizzando il linguaggio PHP 8 basandoci sul framework [Lumen](https://lumen.laravel.com/) e si occuperà di mettere a disposizione del front-end la manipolazione dei dati. Sarà compito del back-end interfacciarsi con il database e manipolare i dati in modo sicuro, utilizzando l'ORM (Object Relational Mapping) che risolve problemi quali query Injection.
    
    Abbiamo inoltre concordato, di utilizzare un database relazionale e abbiamo scelto in particolare un MySQL. Nonostante un database non relazionale offra tempi di risposta migliori (soprattutto al crescere delle dimensioni dei dati da memorizzare), abbiamo deciso di utilizzare un db relazionale perché più affidabile e perché non rilassa le proprietà ACID.
    
    Il prototipo che consegneremo al cliente sarà hostato su Altervista, sia per motivi economici sia perché offre tutte le funzionalità utili per realizzarlo.
    
    All'atto dell'autenticazione verrà creato un token univoco a livello di utente. Una volta autenticato, ad ogni chiamata al back-end verrà inserito nell'header della richiesta il token creato al fine di verificare se il cliente si è effettivamente loggato e sta usufruendo dei servizi cui può accedere.

5.  **Management activities** @Paolo Mazzoleni

6.  **Rischi** @Domenico Gaeni

7.  **Staffing** @Fabio Palazzi
    
    Utilizzando una modalità di sviluppo AGILE, non c'è una vera e propria distinzione fra i ruoli nel team. Inoltre, i task, decisi in comune accordo con il project manager, verranno inseriti come issue su Github e designati ad un programmatore. Nonostante questo, in una panoramica più generale possiamo definire i seguenti ruoli:
    
    - Project Manager: Paolo Mazzoleni
    - Progettista Software: Fabio Palazzi
    - Progettista Database: Domenico Gaeni
    - Back-end Developer: Domenico Gaeni
    - Front-end Developer: Fabio Palazzi
    - Tester: Paolo Mazzoleni

8.  **Methods and techniques** @Fabio Palazzi
    
    Per iniziare, il team si incontrerà per approvare lo ***USE-CASE DIAGRAM*** (precedentemente modellato da project manager e concordato con il cliente) in modo da definire i casi d'uso ovvero le iterazioni fra le varie componenti.
    
    Per modellare il nostro sistema utilizziamo delle ***UML CLASS DIAGRAM**.* Questi diagrammi mostreranno le varie classi del nostro sistema ognuna delle quali conterrà attributi e metodi da implementare. Utilizzando tool esterni riusciremo, a partire dal ***UML CLASS DIAGRAM***, a generare lo scheletro del nostro codice, che sarà OOP (e verrà implementato lato back-end).
    
    Sempre sfruttando la potenza di UML, genereremo anche più ***SEQUENCE DIAGRAM*** in modo da modellare le varie operazioni del sistema come uno scambio di messaggi fra le componenti precedentemente definite. I vari diagrammi forniranno così una linea guida dei passi per implementare ogni singola funzionalità.
    
    Per modellare i dati da salvare nel nostro db, utilizzeremo un **ER CLASS DIAGRAM** dove definiremo le varie tabelle da memorizzare e le varie relazioni (con le diverse cardinalità).
    
    Nel caso durante la fase di implementazione ci accorgessimo dell'impossibilità di implementare funzionalità con la specifica approvata, il team si incontrerà nuovamente al fine di trovare una soluzione funzionante e concordata anche con il cliente.
    
9.  **Quality assurance** @Paolo Mazzoleni

10. **Work packages** @Domenico Gaeni

11. **Resources** @Fabio Palazzi

12. **Budget & schedule** @Domenico Gaeni

13. **Changes** @Paolo Mazzoleni

14. **Delivery** @Fabio Palazzi
