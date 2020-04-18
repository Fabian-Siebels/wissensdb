# Telegram BASH Monitoring

Monitoring Tool für Bash Scripte

Requirements:
- Telegram Account
- Telegram Bot
- Netzwerk

Installation:

#### 1. Einen Bot erstellen

1. BotFather auf Telegram suchen
2. `/newbot` eingeben
3. Name des Bots z.B. `NameMonitoring`
4. Benutzername des Bots mit _bot `NameMonitoring_bot`

Sobald der Bot erstellt wurde, wird ein HTTP Token gesendet, dieser ist sicher Aufzubewahren!

#### 2. Chat ID herrausfinden

Um mit den Bot per Script chatten zu können, muss die Chat ID vorhanden sein.

1. In Telegram den Bot suchen und `/start` eingeben
2. ChatID über das Script `telegramBot.sh` herrausfinden.

#### 3. Telegram Bot zum eigenen Script hinzufügen

1. `AuthToken` Variable ausfüllen
2. `ChatID` Variable ausfüllen
3. Funktion `monitoring` hinzufügen
4. Im Code `monitoring "Text"` platzieren
5. Fertig


Code Monitoring: 

```bash
TOKEN=""
CHAT_ID=""
URL="https://api.telegram.org/bot$TOKEN/sendMessage"

function monitoring() {
    NACHRICHT=$1
    curl -s -X POST $URL -d chat_id=$CHAT_ID -d text="$NACHRICHT" >> /dev/null
}

# Senden an Telegram
monitoring "Hello World!"
```

Code ChatID herrausfinden `telegramBot.sh`

```bash
#!/bin/bash

# Herrausfinden der Telegram ChatID
# + Senden einer Test Nachricht
# + Schreibt die ChatID in eine .txt Datei im selben Verzeichnis

# Requirements
# jq installiert! <- sudo apt install jq

function findechatid() {
    if [[ -f $(which jq 2>/dev/null) ]]; then
        read -p "Eingabe des Telegram AuthTokens: " token
        chatid=$(curl -s "https://api.telegram.org/bot$token/getUpdates" | jq -r ".result[0].message.chat.id")
        echo "Deine Chat ID: $chatid"
        echo "Deine Chat ID: $chatid" >> chatid.txt
        curl -s -X POST https://api.telegram.org/bot$token/sendMessage -d chat_id=$chatid -d text="Hello World!" >> /dev/null
        echo "Eine Test Nachricht wurde versendet!"
    else
        echo "Bitte jq installieren!"
        exit 1
    fi
}

echo "Telegram Bot Monitoring"
echo "GitHub URL: "
echo ""
findechatid
```