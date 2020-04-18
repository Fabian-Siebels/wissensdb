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
