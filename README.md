# Changelog generator for Git and PHP
Generates release notes in [changelog](http://keepachangelog.com/en/0.3.0/) format.
Like this:
```
## [0.0.1] - 2016-12-24
- RepoDetector fix
- Update README.md
- composer binary
- Initial commit
```

And like this:
```
## [0.0.2](https://github.com/f3ath/git-changelog/compare/0.0.1...0.0.2) - 2016-12-24
- Added: README example
```

## Install
With composer:
```bash
composer require f3ath/git-changelog --dev
```

## Usage
For the latest tag:
```bash
vendor/bin/release-notes
```
For an arbitrary tag:
```bash
vendor/bin/release-notes 0.0.3
```

## Configuration
By default, the remote named "origin" is used for getting details about tags, building the comparison URL, etc. 
It is possible to change this behavior by placing a configuration file `.release-notes.json` in the current directory.

```json
{
  "remote": "upstream"
}
```

## Troubleshooting
Make sure you have fetched the latest state of your remote before running the generator.
```bash
git fetch upstream
```

## Contributing
is always welcome.
