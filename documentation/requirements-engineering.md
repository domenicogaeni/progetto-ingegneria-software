# ✏️ Requirements Engineering @Fabio Palazzi

Uno dei passi più importanti prima di scrivere software è quello di analizzare i requisiti, ovvero definire con il cliente sia quelli funzionali (funzionalità del sistema) che quelli non funzionali (tempi di risposta, quantità di dati da immagazzinare ecc. ). In questo caso abbiamo un analisi custom driver perché è proprio il cliente stesso a guidare il team e a fornire i requisiti da implementare.

Oltre ai requisiti che si possono cogliere dal testo del problema, abbiamo organizzato ulteriori meeting per:

- Capire le funzionalità volute dal cliente (*elicitation*).
- Negoziare le funzionalità volute con quelle a nostro parere realizzabili (*negotiation*).
- Specificare i requisiti finali approvati sia dal team che dal cliente e contenuti nel documento **REQUIREMENTS SPECIFICATIONS**.

Il documento citato può subire variazioni a fronte di modifiche richieste dagli attori e concordate con i restanti altri. Queste richieste verranno presentate durante la fase di validazione in cui il team mostrerà al cliente parte del prodotto finale tramite prototipi. Qualora il team avesse fatto errate supposizioni, può concordare con il cliente una soluzione.

Inoltre, il project manager Paolo ha applicato un’ulteriore suddivisione dei requisiti secondo il modello MoSCoW.

Nel documento dei requisiti concordato con il cliente ci siamo accordati sui seguenti:

- **Funzionali:**
    - Must Have:
        - autenticazione cliente tramite mail e password;
        - registrazione di nuovi utenti, senza la verifica dell'indirizzo email e senza l'implementazione della doppia autenticazione;
        - il cliente per accedere alla piattaforma deve essere obbligatoriamente registrato;
        - alla chiusura della pagina web, il cliente dovrà autenticarsi nuovamente per usufruire dei servizi.
        - devono essere memorizzati per ogni cliente: il nome, il cognome, la email,  la password, l’indirizzo di residenza, il numero di telefono e (opzionale) la carta di credito;
        - possibilità per un venditore di inserire un nuovo libro indicando gli attributi descritti nel testo;
        - possibilità per un acquirente di consultare il catalogo dei libri disponibili tramite ricerca con parole chiavi quali titolo, autore, ISBN, genere;
        - possibilità per un utente di acquistare un libro, specificando l'indirizzo di consegna senza effettuare il pagamento: in questa versione infatti non sono gestiti i pagamenti, quindi l'utente per poter acquistare un libro dovrà specificare solo un indirizzo di spedizione.
    - Should have:
        - possibilità per un utente di recensire un prodotto che ha acquistato e il suo venditore;
        - possibilità per un utente di consultare il proprio storico degli acquisti.
    - Won’t have:
        - recupero password tramite email e codice OTP sul numero di telefono;
        - doppia autenticazione tramite codice OTP inviato al numero di telefono.
- **Non Funzionali:**
    - Must have:
        - la password deve essere memorizzata nel db tramite cifratura hash a 256 bit;
        - la password deve essere lunga almeno 12 caratteri, contenente almeno un numero e un simbolo;
        - Il sistema implementato deve essere usufruibile da una vasta gamma di device quali smartphone, tablet e computer.
    - Should have:
        - il tempo di risposta al login di un cliente deve essere inferiore ai 2 secondi;
        - il tempo di ricerca tramite parole chiavi deve essere inferiore ai 2 secondi.
    - Won’t have
        - il codice OTP inviato al numero di telefono (in caso di reset password o di autenticazione) deve arrivare entro 30 secondi la richiesta;
        - il codice OTP inviato per email deve avere una scadenza di 5 minuti;
        - durante la registrazione, o la richiesta di reset delle password, la email deve essere stata inviata entro 1 minuto dalla richiesta.
