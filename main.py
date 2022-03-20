from telegram.ext import *
import responses as r

def start_command(update, context):
    update.message.reply_text('salam bar shoma')

def main():
    updater = Updater('5263621778:AAEMxIktCgfExbYGmmltFHgZ-FjspX5PBcY', use_context=True)
    dp = updater.dispatcher

    dp.add_handler(CommandHandler("start", start_command))
    updater.start_polling()
    updater.idle()

main()