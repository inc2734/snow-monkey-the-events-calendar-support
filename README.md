# Snow Monkey The Events Calendar Integrator

With this plugin, Snow Monkey can use The Events Calendar plugin.

## Build

```bash
$ npm install
$ composer install
$ npm run build
```

## Test

Use Node.js 24.22.1 or later, npm 11.19.1 or later, and Docker.

```bash
$ npm test
```

PHP lint and PHPUnit use the separate `.wp-env.tests.json` environment on port 8889.
The unit test setup downloads Snow Monkey and builds its CSS/JS assets before
loading the theme. Each PHP check stops its test environment when it finishes.
Use `WP_ENV_PORT` to select another port when 8889 is already in use.

## Setup
### ダッシュボード → イベント → 設定 → ディスプレイ
#### イベントテンプレート
「標準イベントテンプレート」以外に設定。

#### Use updated calendar designs
有効化する。
