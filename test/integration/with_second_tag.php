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
            0 => 'git show -q --format=\'%aD\' 0.0.2 --',
            1 =>
                [
                    0 => 'Sat, 24 Dec 2016 17:29:10 -0800',
                ],
        ],
    2 =>
        [
            0 => 'git remote get-url origin',
            1 =>
                [
                    0 => 'git@github.com:f3ath/git-changelog.git',
                ],
        ],
    3 =>
        [
            0 => 'git log 0.0.1..0.0.2',
            1 =>
                [
                    0 => 'commit a913160e9c33639de4f9a87a3812ad9130885150',
                    1 => 'Author: Alexey Karapetov <karapetov@gmail.com>',
                    2 => 'Date:   Sat Dec 24 17:29:10 2016 -0800',
                    3 => '',
                    4 => '    Added: README example',
                ],
        ],
    4 =>
        [
            0 => 'git show -q --format=\'%s\' a913160e9c33639de4f9a87a3812ad9130885150 --',
            1 =>
                [
                    0 => 'Added: README example',
                ],
        ],
];
