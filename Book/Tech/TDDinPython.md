# テスト駆動Python

pytestでのTDDについて。

# 5種類のテスト

1. ユニットテスト
2. 統合テスト
3. システムテスト（E2Eテスト）
4. 機能テスト
5. 皮下テスト

# pytestの構成ファイル

## 基本

- pytest.ini
  - メイン構成ファイル。
- conftest.py
  - ローカルプラグイン。conftest.py配置以下の全ディレクトリでフック関数とフィクスチャが利用可能になる。
- __init__.py
  - テストディレクトリに配置しておくと、複数のテストディレクトリで同盟テストファイルを使用できるようになる。
- tox.ini
  - toxを使用する場合は重要になる。
- setup.cfg
  - パッケージ配布する場合に重要になる。
  - `python setup.py test`

### pytest.iniサンプル

```
[pytest]
addopts = -rsxX -l --tb=short --strict
xfail_strict = true
minversion = 3.0
norecursedirs = .* venv src *.egg dist build
testpaths = tests
```

tox.iniでも全く動揺。
setup.cfgの場合はセクション見出しが`[tool:pytest]`になる。

- `addopts`
  - 標準実行オプション
- `minversion`
  - pytestバージョン下限
- `norecursedirs`
  - 探査しないディレクトリを指定する
- `testpaths`
  - テスト探査対象ディレクトリ一覧を指定する
    - ルートディレクトリを基準とした相対パス
- `xfail_strict`
  - trueを指定すると`@pytest.mark.xfail`マークがついたテストが失敗しなかった場合にエラーとして報告されるようになる。



## テストディスカバリ

- 実行するテストを検索する部分をテストディスカバリ（test discovery）と呼ぶ。
  - テストファイルの名前は`test_<something>.py`または`<something>_test.py`という形式でなければならない
  - テストメソッドやテスト関数の名前は`test_<something>`という形式でなければならない
  - テストクラスの名前は`Test<Something>`という形式でなければならない
- 標準的なルールは次の5つ
  1. 1つ以上のdirから開始する。コマンドラインにファイル名またはdir名を指定でき、指定がなければ現在のdirが使用される。
  2. そのdirと全てのサブdirでテストモジュールを再帰的に調べる
  3. テストモジュールとは、`test_*.py`などの名前がついたファイルのこと
  4. テストモジュールで`test_`で始まる名前の関数を調べる
  5. Testで始まる名前のクラスを調べる。そのうち`__init__`メソッドを持たないクラスで`test_`で始まるメソッドを調べる。
- ルールは変更も可能

## テストを１つだけ実行する

```
pytest -v ch1/test_four.py::test_asdict
```

## オプション指定

### テストが1つでも失敗したら止める

```
pytest -x
```

### テストがN個失敗したら止める

```
pytest --maxfail=2
```

### 最後に失敗したテストだけ実行する

```
pytest --lf
pytest --last-failed
```

### 失敗しているテストのトレースバックの出力方法を変更する

指定しないときはauto

```
pytest --tb=no
pytest --tb=line
pytest --tb=native
pytest --tb=short
pytest --tb=long
pytest --tb=auto
```

### テスト実行後に、時間のかかったテストを表示する

上位いくつを出すか指定する

```
pytest --durations=3
```

# テスト結果の出力内容

- PASSED (.)
  - テスト成功
- FAILED (F)
  - テスト失敗
- SKIPPED (s)
  - スキップされた
- xfail (x)
  - 失敗すると想定したテストが期待通り失敗した
- XPASS (X)
  - 失敗すると想定したテストが成功してしまった
- ERROR (E)
  - テスト関数の外側のフィクスチャ、またはフック関数で例外が発生した

# 併用する他のツール

代表的なもの

## pdb

テストの失敗をデバッグする。
テスト失敗時にpdbの対話型デバッグ機能にアクセスできる。

## coverage.py

カバレッジ計測ツール。
`pytest-cov`を用いる。

```
pytest --cov=src
pytest --cov=src --cov-report=html
```

## mock

モックを使用する。テストダブル、スパイ、フェイク、スタブなどとも呼ばれる。

`pytest-mock`が便利。

モックを使用するテストは、ホワイトボックステストでなければならない。

## tox

テストスイート全体を複数の環境で実行できるようにするコマンドラインツール。
例えば複数のPythonバージョンや、複数のOSの様々な設定でのテストが可能。

## unittest

Python標準ライブラリに組み込まれているテストフレームワーク。
pytestはunittestのテストランナーとして動作し、また同じセッションで実行できる。
unittestベースのテストの実行にpytestを使用できるため、少しずつ移行することも可能。
