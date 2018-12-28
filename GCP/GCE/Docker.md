# GCE docker

今回はGCEインスタンスをDockerコンテナとして直接起動するのではなく、GCEインスタンスを起動してDockerをインストールする。

理由は主にAlways Free枠で頑張るためです。
邪道なのは承知の上。

## 軽く環境確認
```
$ cat /etc/os-release
NAME="Ubuntu"
VERSION="18.04.1 LTS (Bionic Beaver)"
ID=ubuntu
ID_LIKE=debian
PRETTY_NAME="Ubuntu 18.04.1 LTS"
VERSION_ID="18.04"
HOME_URL="https://www.ubuntu.com/"
SUPPORT_URL="https://help.ubuntu.com/"
BUG_REPORT_URL="https://bugs.launchpad.net/ubuntu/"
PRIVACY_POLICY_URL="https://www.ubuntu.com/legal/terms-and-policies/privacy-policy"
VERSION_CODENAME=bionic
UBUNTU_CODENAME=bionic
$ free -m
              total        used        free      shared  buff/cache   available
Mem:            581         158          67           0         355         330
Swap:             0           0           0
```

## スワップ領域を設定していく
```
$ sudo dd if=/dev/zero of=/swapfile bs=1M count=1024
1024+0 records in
1024+0 records out
1073741824 bytes (1.1 GB, 1.0 GiB) copied, 26.5672 s, 40.4 MB/s
$ sudo chmod 600 /swapfile
$ sudo mkswap /swapfile
Setting up swapspace version 1, size = 1024 MiB (1073737728 bytes)
no label, UUID=c174f161-a5ce-4af0-b3ea-c4d74ccb98e3
$ sudo swapon /swapfile
$ free -m
              total        used        free      shared  buff/cache   available
Mem:            581         158          44           0         378         327
Swap:          1023           0        1023
```

### スワップ領域を再起動後も永続化

```
$ cat /etc/fstab
LABEL=cloudimg-rootfs	/	 ext4	defaults	0 0
LABEL=UEFI	/boot/efi	vfat	defaults	0 0
$ sudo sed -i '$ a /swapfile                                 swap                    swap    defaults        0 0' /etc/fstab
$ cat /etc/fstab
LABEL=cloudimg-rootfs	/	 ext4	defaults	0 0
LABEL=UEFI	/boot/efi	vfat	defaults	0 0
/swapfile                                 swap                    swap    defaults        0 0
$ sudo reboot
```

### 再起動してから再度スワップ領域を確認

```
$ free -m
              total        used        free      shared  buff/cache   available
Mem:            579         164         191           0         223         322
Swap:          1023           0        1023
```

## 基本コマンド追加

作業しにくいのでvimやgitいれてdotfilesをセッティングする
```
$ sudo apt-get update
$ sudo apt-get install vim git

$ mkdir -p git/github.com/skxeve && cd $_
$ git clone https://github.com/skxeve/dotfiles.git
$ cd dotfiles
$ ./init.sh

$ exit
```

## Dockerインストール

再度ログインして、dockerをインストール

[Docker Help](https://docs.docker.com/install/linux/docker-ce/ubuntu/#set-up-the-repository)

```
$ sudo apt-get update
$ sudo apt-get install \
    apt-transport-https \
    ca-certificates \
    curl \
    software-properties-common
$ curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
OK
$ sudo apt-key fingerprint 0EBFCD88
pub   rsa4096 2017-02-22 [SCEA]
      9DC8 5822 9FC7 DD38 854A  E2D8 8D81 803C 0EBF CD88
uid           [ unknown] Docker Release (CE deb) <docker@docker.com>
sub   rsa4096 2017-02-22 [S]

$ sudo add-apt-repository \
   "deb [arch=amd64] https://download.docker.com/linux/ubuntu \
   $(lsb_release -cs) \
   stable"

$ sudo apt-get update

$ sudo apt-get install docker-ce

$ echo $?
0
```

### docker動作テスト

```
$ sudo docker run hello-world
Unable to find image 'hello-world:latest' locally
latest: Pulling from library/hello-world
d1725b59e92d: Pull complete
Digest: sha256:0add3ace90ecb4adbf7777e9aacf18357296e799f81cabc9fde470971e499788
Status: Downloaded newer image for hello-world:latest

Hello from Docker!
This message shows that your installation appears to be working correctly.

To generate this message, Docker took the following steps:
 1. The Docker client contacted the Docker daemon.
 2. The Docker daemon pulled the "hello-world" image from the Docker Hub.
    (amd64)
 3. The Docker daemon created a new container from that image which runs the
    executable that produces the output you are currently reading.
 4. The Docker daemon streamed that output to the Docker client, which sent it
    to your terminal.

To try something more ambitious, you can run an Ubuntu container with:
 $ docker run -it ubuntu bash

Share images, automate workflows, and more with a free Docker ID:
 https://hub.docker.com/

For more examples and ideas, visit:
 https://docs.docker.com/get-started/

$ sudo docker ps -a
 CONTAINER ID        IMAGE               COMMAND             CREATED             STATUS                      PORTS               NAMES
 2136b042e37d        hello-world         "/hello"            38 seconds ago      Exited (0) 35 seconds ago                       friendly_easley
```

### Docker再起動対応
```
$ sudo systemctl enable docker
```


### docker-compose

[バージョン参考](https://github.com/docker/compose/releases)

```
$ sudo curl -L https://github.com/docker/compose/releases/download/1.23.2/docker-compose-$(uname -s)-$(uname -m) -o /usr/local/bin/docker-compose
$ sudo chmod +x /usr/local/bin/docker-compose
$ docker-compose --version
```
