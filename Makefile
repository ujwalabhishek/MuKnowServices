dev:
	@docker-compose down --remove-orphans && \
        	docker-compose build --pull --no-cache && \
        	docker-compose \
            		-f docker-compose.yml \
					-f docker-compose.dev.yml \
        	up -d --remove-orphans
	@git fetch --all
	@git checkout dev
	@composer install --working-dir=www/api	
dev-rebuild:
	@docker-compose \
            -f docker-compose.yml \
			-f docker-compose.dev.yml \
        up -d --remove-orphans
	@git pull origin dev
	@composer install --working-dir=www/api			
staging:
	@docker-compose down --remove-orphans && \
        	docker-compose build --pull --no-cache && \
        	docker-compose \
            		-f docker-compose.yml \
					-f docker-compose.staging.yml \
        	up -d --remove-orphans
staging-rebuild:
	@docker-compose \
            		-f docker-compose.yml \
					-f docker-compose.staging.yml \
        	up -d --remove-orphans
prod:
	@docker-compose down --remove-orphans && \
        	docker-compose build --pull --no-cache && \
        	docker-compose \
            		-f docker-compose.yml \
					-f docker-compose.prod.yml \
        	up -d --remove-orphans
prod-rebuild:
	@docker-compose \
            		-f docker-compose.yml \
					-f docker-compose.prod.yml \
        	up -d --remove-orphans