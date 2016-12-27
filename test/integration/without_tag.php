<?php
return [
    0  =>
        [
            0 => 'git ls-remote --tags origin',
            1 =>
                [
                    0 => '9b0d23d15dc2b1f64f671f06bb3d7e634df6a5ed	refs/tags/0.0.1',
                    1 => 'a913160e9c33639de4f9a87a3812ad9130885150	refs/tags/0.0.2',
                    2 => 'ef4285d08081b49437c0c1d11891cbe621e25ce1	refs/tags/0.0.3',
                ],
        ],
    1  =>
        [
            0 => 'git show -q --format=\'%aD\' 0.0.3 --',
            1 =>
                [
                    0 => 'Mon, 26 Dec 2016 23:25:09 -0800',
                ],
        ],
    2  =>
        [
            0 => 'git remote get-url origin',
            1 =>
                [
                    0 => 'git@github.com:f3ath/git-changelog.git',
                ],
        ],
    3  =>
        [
            0 => 'git log 0.0.2..0.0.3',
            1 =>
                [
                    0  => 'commit ef4285d08081b49437c0c1d11891cbe621e25ce1',
                    1  => 'Author: Alexey <f3ath@users.noreply.github.com>',
                    2  => 'Date:   Mon Dec 26 23:25:09 2016 -0800',
                    3  => '',
                    4  => '    Drop hhvm (#2)',
                    5  => '',
                    6  => 'commit 794919698282b98995336a2e9ff43f085d7922cf',
                    7  => 'Author: Alexey Karapetov <karapetov@gmail.com>',
                    8  => 'Date:   Mon Dec 26 23:17:53 2016 -0800',
                    9  => '',
                    10 => '    RepoDetector tests',
                    11 => '',
                    12 => 'commit 1a811d97ae550caab976d73ea3c7252bebc64bb7',
                    13 => 'Author: Alexey <f3ath@users.noreply.github.com>',
                    14 => 'Date:   Mon Dec 26 23:06:49 2016 -0800',
                    15 => '',
                    16 => '    Update README.md',
                    17 => '',
                    18 => 'commit 14870851f9476e2854c323a31b70719f1c112783',
                    19 => 'Author: Alexey Karapetov <karapetov@gmail.com>',
                    20 => 'Date:   Mon Dec 26 23:06:19 2016 -0800',
                    21 => '',
                    22 => '    Travis and phpcs',
                    23 => '',
                    24 => 'commit 191a829a06f5206e21358aadd488403f938e5021',
                    25 => 'Author: Alexey <f3ath@users.noreply.github.com>',
                    26 => 'Date:   Sat Dec 24 17:40:16 2016 -0800',
                    27 => '',
                    28 => '    Update README.md',
                    29 => '',
                    30 => 'commit 661585d564d27489442de0c6adbe4f43659439fb',
                    31 => 'Author: Alexey <f3ath@users.noreply.github.com>',
                    32 => 'Date:   Sat Dec 24 17:39:40 2016 -0800',
                    33 => '',
                    34 => '    Update README.md',
                    35 => '',
                    36 => 'commit fe497ca69d5c8670450c1657c822a74a2176f0f5',
                    37 => 'Author: Alexey <f3ath@users.noreply.github.com>',
                    38 => 'Date:   Sat Dec 24 17:38:53 2016 -0800',
                    39 => '',
                    40 => '    Update README.md',
                    41 => '',
                    42 => 'commit a61c2cb04837155faf9833aad2e1f913df563d5d',
                    43 => 'Author: Alexey <f3ath@users.noreply.github.com>',
                    44 => 'Date:   Sat Dec 24 17:38:09 2016 -0800',
                    45 => '',
                    46 => '    Update README.md',
                    47 => '',
                    48 => 'commit be4fcfdad0b53343917390007b8bbbd2db61f63a',
                    49 => 'Author: Alexey Karapetov <karapetov@gmail.com>',
                    50 => 'Date:   Sat Dec 24 17:31:19 2016 -0800',
                    51 => '',
                    52 => '    Added: Another README example',
                ],
        ],
    4  =>
        [
            0 => 'git show -q --format=\'%s\' ef4285d08081b49437c0c1d11891cbe621e25ce1 --',
            1 =>
                [
                    0 => 'Drop hhvm (#2)',
                ],
        ],
    5  =>
        [
            0 => 'git show -q --format=\'%s\' 794919698282b98995336a2e9ff43f085d7922cf --',
            1 =>
                [
                    0 => 'RepoDetector tests',
                ],
        ],
    6  =>
        [
            0 => 'git show -q --format=\'%s\' 1a811d97ae550caab976d73ea3c7252bebc64bb7 --',
            1 =>
                [
                    0 => 'Update README.md',
                ],
        ],
    7  =>
        [
            0 => 'git show -q --format=\'%s\' 14870851f9476e2854c323a31b70719f1c112783 --',
            1 =>
                [
                    0 => 'Travis and phpcs',
                ],
        ],
    8  =>
        [
            0 => 'git show -q --format=\'%s\' 191a829a06f5206e21358aadd488403f938e5021 --',
            1 =>
                [
                    0 => 'Update README.md',
                ],
        ],
    9  =>
        [
            0 => 'git show -q --format=\'%s\' 661585d564d27489442de0c6adbe4f43659439fb --',
            1 =>
                [
                    0 => 'Update README.md',
                ],
        ],
    10 =>
        [
            0 => 'git show -q --format=\'%s\' fe497ca69d5c8670450c1657c822a74a2176f0f5 --',
            1 =>
                [
                    0 => 'Update README.md',
                ],
        ],
    11 =>
        [
            0 => 'git show -q --format=\'%s\' a61c2cb04837155faf9833aad2e1f913df563d5d --',
            1 =>
                [
                    0 => 'Update README.md',
                ],
        ],
    12 =>
        [
            0 => 'git show -q --format=\'%s\' be4fcfdad0b53343917390007b8bbbd2db61f63a --',
            1 =>
                [
                    0 => 'Added: Another README example',
                ],
        ],
];
