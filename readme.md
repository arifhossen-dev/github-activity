# GitHub Activity CLI

A lightweight command-line interface tool built with PHP 8.4 that fetches and displays GitHub user activity in real-time. This tool allows developers to quickly check any GitHub user's recent activities directly from their terminal.

![GitHub Activity CLI Demo](demo.gif)

## 🚀 Features

- **Zero Dependencies**: Pure PHP implementation without external packages
- **Real-time Activity**: Fetch latest GitHub activities instantly
- **Multiple Event Types**: Support for various GitHub events:
  - Push events
  - Issue events
  - Star events
  - Fork events
  - Create events (branches, tags)
- **Error Handling**: Graceful error management with meaningful messages
- **User-Friendly Output**: Clean, formatted activity display
- **Modern PHP**: Leverages PHP 8.4 features

## 🔧 Requirements

- PHP 8.4 or higher
- Composer (for installation)

## ⚡ Installation

```bash
# Clone the repository
git clone https://github.com/yourusername/github-activity.git

# Navigate to the project directory
cd github-activity

# Install dependencies
composer install

# Make the CLI tool executable
chmod +x bin/github-activity

# Optional: Install globally
composer global require yourusername/github-activity
```

## 📖 Usage

```bash
# Basic usage
./bin/github-activity <username>

# Example
./bin/github-activity arifhossen-dev
```

### Sample Output
```
Recent activity for arifhossen-dev:
- Pushed 3 commits to arifhossen-dev/developer-roadmap
- Created branch "feature/new-roadmap" in arifhossen-dev/developer-roadmap
- Opened issue #123 in arifhossen-dev/developer-roadmap
- Starred facebook/react
```

## 🛠️ Technical Details

The tool uses GitHub's public API to fetch user activities:
- Endpoint: `https://api.github.com/users/<username>/events`
- No authentication required for basic usage
- Implements proper error handling for API failures
- Uses native PHP streams for HTTP requests

## 🎯 Code Structure

```
github-activity/
├── src/
│   ├── GitHubActivity.php
│   └── Exceptions/
│       └── GitHubException.php
├── bin/
│   └── github-activity
└── composer.json
```

## 🤝 Contributing

Contributions are welcome! Here's how you can help:

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Development Setup

```bash
# Clone your fork
git clone https://github.com/your-username/github-activity.git

# Install dependencies
composer install

# Run tests
composer test
```

## 📝 Planned Features

- [ ] Pagination support for more activities
- [ ] Colorized terminal output
- [ ] Rate limiting handling
- [ ] Activity filtering by event type
- [ ] Date/time information in output
- [ ] OAuth support for authenticated requests

## 📜 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🙏 Acknowledgments

- GitHub API Documentation
- PHP Community
- All contributors who help improve this tool

## 📞 Support

If you encounter any issues or have questions:

- Create an issue in the GitHub repository
- Contact the maintainer at [your-email@example.com]

## 🌟 Star History

[![Star History Chart](https://api.star-history.com/svg?repos=yourusername/github-activity&type=Date)](https://star-history.com/#yourusername/github-activity&Date)

---

Made with ❤️ by arifhossen.dev

