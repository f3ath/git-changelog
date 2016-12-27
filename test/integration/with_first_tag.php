<?php
return [
    0 =>
        [
            0 => 'git ls-remote --tags origin',
            1 =>
                [
                    0 => '9b0d23d15dc2b1f64f671f06bb3d7e634df6a5ed	refs/tags/0.0.1',
                    1 => 'a913160e9c33639de4f9a87a3812ad9130885150	refs/tags/0.0.2',
                    2 => 'ef4285d08081b49437c0c1d11891cbe621e25ce1	refs/tags/0.0.3',
                ],
        ],
    1 =>
        [
            0 => 'git show -q --format=\'%aD\' 0.0.1 --',
            1 =>
                [
                    0 => 'Sat, 24 Dec 2016 17:16:55 -0800',
                ],
        ],
    2 =>
        [
            0 => 'git log 0.0.1',
            1 =>
                [
                    0  => 'commit 9b0d23d15dc2b1f64f671f06bb3d7e634df6a5ed',
                    1  => 'Merge: 16b6371 39ea46e',
                    2  => 'Author: Alexey Karapetov <karapetov@gmail.com>',
                    3  => 'Date:   Sat Dec 24 17:16:55 2016 -0800',
                    4  => '',
                    5  => '    Merge branch \'master\' of github.com:f3ath/git-changelog',
                    6  => '',
                    7  => 'commit 16b63719da76e9525f956158a26f7746aa32ed77',
                    8  => 'Author: Alexey Karapetov <karapetov@gmail.com>',
                    9  => 'Date:   Sat Dec 24 17:16:44 2016 -0800',
                    10 => '',
                    11 => '    RepoDetector fix',
                    12 => '',
                    13 => 'commit 39ea46e237ed5f0cf8ccdb87d4ee62ca775256d1',
                    14 => 'Author: Alexey <f3ath@users.noreply.github.com>',
                    15 => 'Date:   Sat Dec 24 17:07:33 2016 -0800',
                    16 => '',
                    17 => '    Update README.md',
                    18 => '',
                    19 => 'commit 46340ef8d73e1f031398f93d7006450e3f129188',
                    20 => 'Author: Alexey Karapetov <karapetov@gmail.com>',
                    21 => 'Date:   Sat Dec 24 17:05:46 2016 -0800',
                    22 => '',
                    23 => '    composer binary',
                    24 => '',
                    25 => 'commit 3fe2a1a934b292416e35843815898b2f352e69ac',
                    26 => 'Author: Alexey Karapetov <f3ath@users.noreply.github.com>',
                    27 => 'Date:   Tue Nov 15 01:54:52 2016 -0800',
                    28 => '',
                    29 => '    Initial commit',
                ],
        ],
    3 =>
        [
            0 => 'git show -q --format=\'%s\' 9b0d23d15dc2b1f64f671f06bb3d7e634df6a5ed --',
            1 =>
                [
                    0 => 'Merge branch \'master\' of github.com:f3ath/git-changelog',
                ],
        ],
    4 =>
        [
            0 => 'git show -q --format=\'%s\' 16b63719da76e9525f956158a26f7746aa32ed77 --',
            1 =>
                [
                    0 => 'RepoDetector fix',
                ],
        ],
    5 =>
        [
            0 => 'git show -q --format=\'%s\' 39ea46e237ed5f0cf8ccdb87d4ee62ca775256d1 --',
            1 =>
                [
                    0 => 'Update README.md',
                ],
        ],
    6 =>
        [
            0 => 'git show -q --format=\'%s\' 46340ef8d73e1f031398f93d7006450e3f129188 --',
            1 =>
                [
                    0 => 'composer binary',
                ],
        ],
    7 =>
        [
            0 => 'git show -q --format=\'%s\' 3fe2a1a934b292416e35843815898b2f352e69ac --',
            1 =>
                [
                    0 => 'Initial commit',
                ],
        ],
];
