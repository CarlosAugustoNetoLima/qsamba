.PHONY: start stop

# Comando padrão ao digitar apenas 'make'
start:
	@echo "Iniciando Q'SAMBA em http://localhost:8000..."
	php -S localhost:8000

# Comando para parar o servidor (útil se rodar em background)
stop:
	@pkill -f "php -S localhost:8000" || echo "Servidor não está rodando."
