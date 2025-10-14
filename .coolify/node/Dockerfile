# ---------- Build Stage ----------
FROM node:22-alpine AS build
WORKDIR /app

COPY frontend/package.json frontend/package-lock.json ./
RUN npm ci

COPY frontend/ ./
RUN npm run build

# ---------- Runtime Stage ----------
FROM node:22-alpine
WORKDIR /app

COPY --from=build /app/.output/ ./

ENV PORT=3000
ENV HOST=0.0.0.0
EXPOSE 3000

CMD ["node", "/app/server/index.mjs"]
