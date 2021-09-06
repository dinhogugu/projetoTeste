# buiildar
FROM node:10-alpine as builder

WORKDIR /vue-ui

# copia o package e instala dependencias
COPY package*.json ./
RUN npm install

# copia o resto dos arquivos
COPY . .

# Build o projeto
RUN npm run build


FROM nginx:alpine as production-build
COPY ./.nginx/nginx.conf /etc/nginx/nginx.conf

## remove a pagina defult do nginx
RUN rm -rf /usr/share/nginx/html/*

COPY --from=builder /vue-ui/dist /usr/share/nginx/html

EXPOSE 80
ENTRYPOINT ["nginx", "-g", "daemon off;"]