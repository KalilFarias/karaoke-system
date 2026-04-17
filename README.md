# 🎤 Karaoke Queue System

Sistema web para gerenciamento de fila de karaokê, desenvolvido com Laravel.

## 🚀 Funcionalidades

- Cadastro e autenticação de usuários
- Adição de músicas à fila
- Organização automática por ordem de chegada
- Painel administrativo para controle da fila
- Finalização de músicas (admin)
- Interface moderna com TailwindCSS

## 🛠️ Tecnologias utilizadas

- PHP 8+
- Laravel
- Blade
- TailwindCSS
- MySQL

## 🎯 Objetivo

Este projeto foi desenvolvido com o objetivo de simular um sistema real utilizado em bares e pubs para organizar apresentações de karaokê de forma simples e eficiente.

## 📸 Interface

Interface inspirada em ambientes de pub/bar, com tema dark e foco em usabilidade.

## 📌 Melhorias futuras

- Atualização da fila em tempo real (WebSockets)
- Sistema de votação de músicas
- Painel público (TV)
- Integração com APIs de música

## ⚙️ Como rodar o projeto

```bash
git clone ...
cd projeto

cp .env.example .env
php artisan key:generate

docker-compose up -d
# ou
php artisan serve
