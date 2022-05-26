FROM caddy:2-builder-alpine AS caddy_builder

RUN xcaddy build \
	--with github.com/dunglas/mercure \
	--with github.com/dunglas/mercure/caddy \
	--with github.com/dunglas/vulcain \
	--with github.com/dunglas/vulcain/caddy

FROM caddy:2 AS caddy

WORKDIR /srv/app/

COPY --from=dunglas/mercure:v0.11 /srv/public /srv/mercure-assets/
COPY --from=caddy_builder /usr/bin/caddy /usr/bin/caddy
COPY --from=php /srv/app/public/ public/
