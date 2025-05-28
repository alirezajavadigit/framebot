# FrameBot – PHP Telegram Bot Framework

**FrameBot is a lightweight PHP Telegram Bot framework that helps you build, test and deploy bots fast with Composer, PSR‑12 tooling and typed middleware.**

[![Version](https://img.shields.io/badge/version-2.13.0-blue.svg)](https://github.com/alirezajavadigit/framebot)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![GitHub Stars](https://img.shields.io/github/stars/alirezajavadigit/framebot.svg?style=social)](https://github.com/alirezajavadigit/framebot/stargazers)


> **Fast** · **Secure** · **Eloquent-style ORM** · **Telegram API First**

## 📺 Getting Started Video
[![FrameBot Tutorial](https://i.pcmag.com/imagery/articles/02stCRlZlZJudzKvwJ29HQO-1..v1569484288.jpg)](https://www.youtube.com/watch?v=sEf4MRW0YiE "Watch FrameBot Tutorial")

## ✨ Key Features

### 🗄️ Database Superpowers
- **Eloquent-style ORM** - Familiar Active Record implementation
  ```php
  $user = User::find(1)->update(['username' => 'framebot_user']);
- **Migrations System** - Version-controlled database schema management
- **Relationship Support** - HasMany, BelongsTo, Polymorphic relations

## 🤖 Telegram Integration
- **Auto-Send Architecture** - RAII pattern for seamless API calls
 ```php
  Message::chatId($this->chatID)->text("welcome to my telegram bot");
  // Automatically sends on destruct
```
### 25+ API Components - Pre-built classes for:
  - 📍 Locations & Venues
  - 🎲 Interactive Dice/Polls
  - 💌 Media Groups & Paid Content
  - 🎭 Message Reactions
### 🛡️ Security First
- Dotenv Implementation - Secure credential management
- Auto-Sanitization - Built-in parameter validation
- Request Throttling - Protection against API abuse
### **Section 3: Quick Start**

## 🚀 Quick Start

### Requirements
- PHP 8.0+
- Composer
- MySQL

### Installation
```bash
git clone https://github.com/alirezajavadigit/framebot.git
cd framebot
composer install
cp .env.example .env
```
### Configuration (.env)
```ini 
# Telegram Configuration
TOKEN=your_bot_token_here
APP_ENV=production

# Database Settings
DB_HOST=127.0.0.1
DB_NAME=framebot
DB_USERNAME=root
DB_PASSWORD=
```
### **Section 5: Contributing & Community**
## 🤝 Contributing

We welcome contributions! Please follow these steps:

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit changes (`git commit -m 'Add some amazing feature'`)
4. Push to branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

**Contribution Guidelines**:
- Follow PSR-12 coding standards
- Include PHPDoc comments
- Add unit tests for new features
- Update documentation accordingly

## 🌍 Community

- [GitHub Discussions](https://github.com/alirezajavadigit/framebot/discussions) - Q&A and general help
- [Telegram Channel](https://t.me/framebot_community) - Announcements & updates & Q&A
## 📜 License

MIT License - See [LICENSE](LICENSE) for full text

**Created with ❤️ by [Alireza Javadi](https://github.com/alirezajavadigit)**  
**Part of the Open Source Telegram Bot Ecosystem** 🤖
