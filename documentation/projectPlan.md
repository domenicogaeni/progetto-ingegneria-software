# Project plan

1.  **Introduzione**: @Domenico Gaeni

2.  **Modello di processo** @Paolo Mazzoleni

    Per il processo di sviluppo del prototipo abbiamo optato per un approccio di tipo Agile, infatti puntiamo a rilasciare una versione di base del prodotto e integrarla mano a mano con piccoli aggiornamenti che porteranno con sé le funzionalità descritte sopra, in modo da facilitare anche le fasi di testing e debugging.
    
    Fondamentale sarà il rapporto con Mario, che sarà invitato a partecipare alle riunioni settimanali sullo stato di sviluppo del software e in particolare nella fase di progettazione.
    
    Per tenere traccia dello sviluppo delle funzionalità richieste, optiamo per l'utilizzo delle issue su Github, che saranno assegnate settimanalmente a ogni componente del gruppo in base a quello che si decide nei meeting. Mano a mano che ognuno andrà a completare i punti che gli sono stati assegnati, le issue verranno chiuse e i documenti pubblicati sulla piattaforma.

3.  **Organizzazione del progetto** @Domenico Gaeni

4.  **Standards, guidelines, procedures** @Fabio Palazzi

5.  **Management activities** @Paolo Mazzoleni

    Abbiamo deciso di organizzarci secondo la filosofia dello "swat team" (Skilled Workers with Avdanced Tools): gli incontri saranno settimanali e relativamente brevi, della durata di un'ora circa. Durante gli stessi potranno essere effettuate sessioni di brainstorming per condividere idee e risolvere problemi.
    Il team di sviluppo si pone l'obiettivo di incontrarsi settimanalmente per aggiornarsi sullo stato dei lavori. In base alle esigenze si decide se effettuare la riunione virtualmente tramite la piattaforma Google Meet o se è necessario incontrarsi e svolgerla di persona.
    
    Ad ogni incontro, i membri del gruppo espongono brevemente quali sono stati i punti portati avanti e quali sono state le problematiche incontrate sul proprio cammino. Mano a mano che si procede nell'esposizione, si aggiorna un documento che tiene traccia dei lavori svolti fino a quel momento. Alla fine di ogni meeting verrà scritta una breve relazione in merito a quanto discusso.
    
    Alla fine del meeting ci si accorda su quali sono i punti da portare avanti; sarà il project manager ad assegnare a ciascun membro del gruppo, se stesso compreso, i compiti che dovranno essere eseguiti prima del prossimo incontro.

6.  **Rischi** @Domenico Gaeni

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

11. **Resources** @Fabio Palazzi

12. **Budget & schedule** @Domenico Gaeni

13. **Changes** @Paolo Mazzoleni

    Oltre alle feature base incluse inizialmente nel prodotto e descritte al punto uno di questo documento, l'obiettivo sarà quello di mettere le basi per ulteriori funzionalità allo scopo di fornire un servizio più completo, in accordo con Mario. Queste verranno inserite nelle successive versioni del software e includeranno:
    
    - un carrello, nel quale i clienti potranno inserire prodotti da acquistare ed effettuare un unico pagamento, a differenza di quello che avviene nella versione base del software nella quale è necessario effettuare un pagamento separato per ogni prodotto;
    - liste desideri, nelle quali i clienti potranno inserire prodotti per eventuali acquisti futuri, con la possibilità di crearne più di una e ad ognuna assegnare un nome;
    - una dashboard personalizzata per ogni cliente, che varierà in base all'autore/genere di libri acquistati in precedenza;
    - la possibilità di salvare un metodo di pagamento (carta di debito/credito/prepagata) per poterla utilizzare negli acquisti futuri senza la necessità di inserirla ogni volta;
    - la possibilità di acquistare buoni regalo con credito spendibile sul sito.

14. **Delivery** @Fabio Palazzi
