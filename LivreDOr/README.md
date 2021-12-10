## Livre D'Or

- On aura une page avec un formulaire
    - Un champ pour le nom d'utilisateur
    - Un champ message
    - Un bouton
    Le formulaire devra être validé et on n'acceptera pas les pseudos de moins de 3 caractères ni les
    messages de moins de 10 caractères

- On créera un fichier "messages" qui contiendra un message par ligne
    (on utilisera serialize et un tableau ['username' => '....', 'message' => '....', 'date' => '....'])
    - Pour sérializer les messages, on utilisera les fonctions json_encode(tableau) et json_decode(tableau, true)

- La page devra afficher tous les messages sous le formulaire de la manière suivante :
<p>
    <strong>Pseudo</strong> <em>le dd/mm/YYYY à HHhMM</em><br>
</p>
(Les sauts de ligne devront être conservés avec la fonction nl2br)

## Restrictions

- Utiliser une classe pour représenter un Message
    - new Message(string $username, string $message, DateTime $date)
    - isValid(): bool
    - getErrors(): array
    - toHTML(): string
    - toJSON(): string
    - Message::fromJSON(string): Message

- Utiliser une classe pour représenter le livre d'or (GuestBook)
    - new GuestBook($file)
    - addMessage(Message $message)
    - getMessages(): array
