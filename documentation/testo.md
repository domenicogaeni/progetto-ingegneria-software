# Testo

Si gestisca una piattaforma software di vendita di libri fisici. Per accedere alla piattaforma, il cliente deve essere registrato. Inoltre il cliente, può essere contemporaneamente venditore e compratore. All'atto della registrazione dovranno essere memorizzati: il nome, il cognome, la email, la password, l'indirizzo di residenza, il numero di telefono e (opzionale) la carta di credito. La password dovrà essere memorizzata tramite cifratura HASH a 256 bit. All'atto della registrazione, deve essere verificato l'indirizzo email. Inoltre, al fine di rendere il sistema più sicuro, è richiesta la doppia autenticazione attraverso un codice OTP inviato al numero di telefono.

In caso di password dimenticata, il sistema deve mandare un'email di reset password contenente un link che attiverà la procedura di ripristino della password. Il link presente nella email avrà scadenza di 1h dalla sua ricezione. In particolare prima di procedere con l'inserimento della nuova password il sistema deve chiedere l'OTP sul numero di telefono dell'utente coinvolto.

Il sistema offre le seguenti funzionalità ai propri utenti:

- Il venditore ha la possibilità di inserire un annuncio di vendita di un libro specificando: titolo, codice ISBN, autori, prezzo, quantità, genere.
- Un utente ha la possibilità di ricercare dei libri tramite i seguenti criteri: titolo, autore, ISBN, genere;
- Un utente ha la possibilità di acquistare un libro in vendita.
In fase di check out deve essere specificato l'indirizzo di consegna (in caso sia diverso da quello specificato all'atto della registrazione) e il metodo di pagamento (Paypal, carta di credito). 
Quando il sistema riceverà i soldi del libro, notificherà il venditore tramite un'email, in particolare sarà poi compito del venditore spedire il libro all'indirizzo indicato per email entro i giorni successivi all'acquisto.
Inoltre, l'importo viene trattenuto dal sistema e il venditore riceverà la somma dovuta a consegna effettuata oppure se non verranno aperte contestazioni da parte dell'acquirente entro 30 giorni. Le contestazioni verranno aperte tramite un'apposita funzione del sistema e sarà poi compito del personale che gestisce la piattaforma contattare il venditore per informarsi sulla spedizione e/o procedere con il rimborso all'acquirente.
- Un utente potrà consultare il proprio storico di acquisti: dovranno essere memorizzati tutti i prodotti acquistati e venduti dal cliente per almeno 5 anni;
- Un utente dopo aver acquistato un libro potrà recensire il venditore: al fine di evitare truffe e venditori scorretti, il sistema deve permettere di valutare l'acquirente tramite una recensione (*punteggio da 1 a 5 con testo opzionale*)
- Un utente dopo aver acquistato un libro potrà recensire il prodotto: un acquirente può valutare il libro acquistato tramite una recensione (*punteggio da 1 a 5 con testo opzionale*).
