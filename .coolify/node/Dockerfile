# ---------- Build Stage ----------
FROM node:22-alpine AS build
WORKDIR /app

# Lockfile-Name korrigieren:
COPY package.json package-lock.json ./
RUN npm ci

# Projektdateien
COPY . ./
RUN npm run build   # erzeugt .output

# ---------- Runtime Stage ----------
FROM node:22-alpine
WORKDIR /app

# Nur das .output aus dem Build übernehmen
COPY --from=build /app/.output/ ./

# Nuxt Nitro-Server: wir nutzen 3000 intern
ENV PORT=3000
ENV HOST=0.0.0.0
EXPOSE 3000

CMD ["node", "/app/server/index.mjs"]
