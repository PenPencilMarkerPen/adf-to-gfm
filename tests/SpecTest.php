<?php

declare(strict_types=1);

use Karvaka\AdfToGfm\Converter;

it('meets specification', function (string $gfm, string $adf) {
    expect((new Converter())->convert($adf)->toMarkdown())->toBe($gfm);
})->with('specs');

dataset('specs', [
    'blockCard' => [
        'https://karvaka.com',
        <<<'ADF'
{
  "type": "blockCard",
  "attrs": {
    "url": "https:\/\/karvaka.com"
  }
}
ADF
    ],
   'blockquote' => [
       <<<'GFM'
> Simplicity is the ultimate sophistication. - Leonardo da Vinci
>
> Well begun is half done. - Aristotle
GFM,
       <<<'ADF'
{
    "type": "blockquote",
    "content": [
        {
            "type": "paragraph",
            "content": [
                {
                    "type": "text",
                    "text": "Simplicity is the ultimate sophistication. - Leonardo da Vinci"
                }
            ]
        },
        {
            "type": "paragraph",
            "content": [
                {
                    "type": "text",
                    "text": "Well begun is half done. - Aristotle"
                }
            ]
        }
    ]
}
ADF
   ],
    'bulletList' => [
        <<<'GFM'
- Leonardo
- Raphael
- Donatello
- Michelangelo
GFM,
        <<<'ADF'
{
    "type": "bulletList",
    "content": [
        {
            "type": "listItem",
            "content": [
                {
                    "type": "paragraph",
                    "content": [
                        {
                            "type": "text",
                            "text": "Leonardo"
                        }
                    ]
                }
            ]
        },
        {
            "type": "listItem",
            "content": [
                {
                    "type": "paragraph",
                    "content": [
                        {
                            "type": "text",
                            "text": "Raphael"
                        }
                    ]
                }
            ]
        },
        {
            "type": "listItem",
            "content": [
                {
                    "type": "paragraph",
                    "content": [
                        {
                            "type": "text",
                            "text": "Donatello"
                        }
                    ]
                }
            ]
        },
        {
            "type": "listItem",
            "content": [
                {
                    "type": "paragraph",
                    "content": [
                        {
                            "type": "text",
                            "text": "Michelangelo"
                        }
                    ]
                }
            ]
        }
    ]
}
ADF
    ],
    'nested lists' => [
        <<<'GFM'
- First level item one
    1. Nested numbered list item one
    2. Nested numbered list item two
        - Nested bullet list item one
        - Nested bullet list item two
            - More nested bullet list item one
            - More nested bullet list item two
    3. Nested numbered list item three
- First level item two
GFM,
        <<<'ADF'
{
  "type": "bulletList",
  "content": [
    {
      "type": "listItem",
      "content": [
        {
          "type": "paragraph",
          "content": [
            {
              "type": "text",
              "text": "First level item one"
            }
          ]
        },
        {
          "type": "orderedList",
          "content": [
            {
              "type": "listItem",
              "content": [
                {
                  "type": "paragraph",
                  "content": [
                    {
                      "type": "text",
                      "text": "Nested numbered list item one"
                    }
                  ]
                }
              ]
            },
            {
              "type": "listItem",
              "content": [
                {
                  "type": "paragraph",
                  "content": [
                    {
                      "type": "text",
                      "text": "Nested numbered list item two"
                    }
                  ]
                },
                {
                  "type": "bulletList",
                  "content": [
                    {
                      "type": "listItem",
                      "content": [
                        {
                          "type": "paragraph",
                          "content": [
                            {
                              "type": "text",
                              "text": "Nested bullet list item one"
                            }
                          ]
                        }
                      ]
                    },
                    {
                      "type": "listItem",
                      "content": [
                        {
                          "type": "paragraph",
                          "content": [
                            {
                              "type": "text",
                              "text": "Nested bullet list item two"
                            }
                          ]
                        },
                        {
                          "type": "bulletList",
                          "content": [
                            {
                              "type": "listItem",
                              "content": [
                                {
                                  "type": "paragraph",
                                  "content": [
                                    {
                                      "type": "text",
                                      "text": "More nested bullet list item one"
                                    }
                                  ]
                                }
                              ]
                            },
                            {
                              "type": "listItem",
                              "content": [
                                {
                                  "type": "paragraph",
                                  "content": [
                                    {
                                      "type": "text",
                                      "text": "More nested bullet list item two"
                                    }
                                  ]
                                }
                              ]
                            }
                          ]
                        }
                      ]
                    }
                  ]
                }
              ]
            },
            {
              "type": "listItem",
              "content": [
                {
                  "type": "paragraph",
                  "content": [
                    {
                      "type": "text",
                      "text": "Nested numbered list item three"
                    }
                  ]
                }
              ]
            }
          ]
        }
      ]
    },
    {
      "type": "listItem",
      "content": [
        {
          "type": "paragraph",
          "content": [
            {
              "type": "text",
              "text": "First level item two"
            }
          ]
        }
      ]
    }
  ]
}
ADF,
    ],
    'codeBlock' => [
        <<<'GFM'
```php
git status
git add
git commit
```
GFM,
        '{
    "type": "codeBlock",
    "attrs": {
        "language": "php"
    },
    "content": [
        {
            "type": "text",
            "text": "git status\ngit add\ngit commit"
        }
    ]
}',
    ],
    'date' => [
        'Jun 28 2022',
        <<<'ADF'
{
    "type": "date",
    "attrs": {
        "timestamp": "1656374400000"
    }
}
ADF
    ],
    'doc' => [
        '',
        <<<'ADF'
{
    "version": 1,
    "type": "doc",
    "content": []
}
ADF
    ],
    'emoji' => [
        '🥴',
        <<<'ADF'
{
    "type": "emoji",
    "attrs": {
        "shortName": ":woozy_face:",
        "text": "🥴"
    }
}
ADF
    ],
    'expand' => [
        <<<'GFM'
<details>
  <summary>Expandable panel</summary>
  With content
</details>
GFM,
        <<<'ADF'
{
  "type": "expand",
  "content": [
    {
      "type": "paragraph",
      "content": [
        {
          "type": "text",
          "text": "With content"
        }
      ]
    }
  ],
  "attrs": {
    "title": "Expandable panel"
  }
}
ADF
    ],
    'heading 1' => [
        '# Heading 1',
        <<<'ADF'
{
    "type": "heading",
    "attrs": {
        "level": 1
    },
    "content": [
        {
            "type": "text",
            "text": "Heading 1"
        }
    ]
}
ADF
    ],
    'heading 2' => [
        '## Heading 2',
        <<<'ADF'
{
    "type": "heading",
    "attrs": {
        "level": 2
    },
    "content": [
        {
            "type": "text",
            "text": "Heading 2"
        }
    ]
}
ADF
    ],
    'heading 3' => [
        '### Heading 3',
        <<<'ADF'
{
    "type": "heading",
    "attrs": {
        "level": 3
    },
    "content": [
        {
            "type": "text",
            "text": "Heading 3"
        }
    ]
}
ADF
    ],
    'heading 4' => [
        '#### Heading 4',
        <<<'ADF'
{
    "type": "heading",
    "attrs": {
        "level": 4
    },
    "content": [
        {
            "type": "text",
            "text": "Heading 4"
        }
    ]
}
ADF
    ],
    'heading 5' => [
        '##### Heading 5',
        <<<'ADF'
{
    "type": "heading",
    "attrs": {
        "level": 5
    },
    "content": [
        {
            "type": "text",
            "text": "Heading 5"
        }
    ]
}
ADF
    ],
    'heading 6' => [
        '###### Heading 6',
        <<<'ADF'
{
    "type": "heading",
    "attrs": {
        "level": 6
    },
    "content": [
        {
            "type": "text",
            "text": "Heading 6"
        }
    ]
}
ADF
    ],
    'inlineCard' => [
        'https://karvaka.com',
        <<<'ADF'
{
  "type": "inlineCard",
  "attrs": {
    "url": "https:\/\/karvaka.com"
  }
}
ADF
    ],
    'mention' => [
        '@Mention',
        <<<'ADF'
{
    "type": "mention",
    "attrs": {
        "id": "123123123",
        "text": "@Mention",
        "accessLevel": ""
    }
}
ADF
    ],
    'orderedList' => [
        <<<'ADF'
1. Leonardo
2. Raphael
3. Donatello
4. Michelangelo
ADF,
        <<<'GFM'
{
    "type": "orderedList",
    "content": [
        {
            "type": "listItem",
            "content": [
                {
                    "type": "paragraph",
                    "content": [
                        {
                            "type": "text",
                            "text": "Leonardo"
                        }
                    ]
                }
            ]
        },
        {
            "type": "listItem",
            "content": [
                {
                    "type": "paragraph",
                    "content": [
                        {
                            "type": "text",
                            "text": "Raphael"
                        }
                    ]
                }
            ]
        },
        {
            "type": "listItem",
            "content": [
                {
                    "type": "paragraph",
                    "content": [
                        {
                            "type": "text",
                            "text": "Donatello"
                        }
                    ]
                }
            ]
        },
        {
            "type": "listItem",
            "content": [
                {
                    "type": "paragraph",
                    "content": [
                        {
                            "type": "text",
                            "text": "Michelangelo"
                        }
                    ]
                }
            ]
        }
    ]
}
GFM
    ],
    'paragraph with text' => [
        'Some text goes here.',
        <<<'ADF'
{
    "type": "paragraph",
    "content": [
        {
            "type": "text",
            "text": "Some "
        },
        {
            "type": "text",
            "text": "text"
        },
        {
            "type": "text",
            "text": " goes here."
        }
    ]
}
ADF
    ],
    'rule' => [
        '* * *',
        <<<'ADF'
{
    "type": "rule"
}
ADF
    ],
    'text' => [
        'Some text goes here.',
        <<<'ADF'
{
    "type": "text",
    "text": "Some text goes here."
}
ADF
    ],
    'text code' => [
        '`Some inline code goes here.`',
        <<<'ADF'
{
    "type": "text",
    "text": "Some inline code goes here.",
    "marks": [
        {
            "type": "code"
        }
    ]
}
ADF
    ],
    'text em' => [
        '*Some italic text goes here.*',
        <<<'ADF'
{
    "type": "text",
    "text": "Some italic text goes here.",
    "marks": [
        {
            "type": "em"
        }
    ]
}
ADF
    ],
    'text link' => [
        '[Some website goes here.](https://karvaka.com/)',
        <<<'ADF'
{
    "type": "text",
    "text": "Some website goes here.",
    "marks": [
        {
            "type": "link",
            "attrs": {
                "href": "https://karvaka.com/"
            }
        }
    ]
}
ADF
    ],
    'text link with title' => [
        '[Some website goes here.](https://karvaka.com/ "Click to visit")',
        <<<'ADF'
{
    "type": "text",
    "text": "Some website goes here.",
    "marks": [
        {
            "type": "link",
            "attrs": {
                "href": "https://karvaka.com/",
                "title": "Click to visit"
            }
        }
    ]
}
ADF
    ],
    'text strike' => [
        '~~Some strike text goes here.~~',
        <<<'ADF'
{
    "type": "text",
    "text": "Some strike text goes here.",
    "marks": [
        {
            "type": "strike"
        }
    ]
}
ADF
    ],
    'text strong' => [
        '**Some bold text goes here.**',
        <<<'ADF'
{
    "type": "text",
    "text": "Some bold text goes here.",
    "marks": [
        {
            "type": "strong"
        }
    ]
}
ADF
    ],
    'status' => [
        '⚪ **NEUTRAL**',
        <<<'ADF'
{
  "type": "status",
  "attrs": {
    "text": "NEUTRAL",
    "color": "neutral",
    "localId": "179e31c7-571b-40e5-a67a-88b62606a6af",
    "style": ""
  }
}
ADF
    ],
    'table without header' => [
        <<<'GFM'
|  |  |
| --- | --- |
| Row one, cell one | Row one, cell two |
| Row two, cell one | Row two, cell two |
| Row three, cell one | Row three, cell two |
GFM,
        <<<'ADF'
{
    "type": "table",
    "attrs": {
        "isNumberColumnEnabled": false,
        "layout": "default"
    },
    "content": [
        {
            "type": "tableRow",
            "content": [
                {
                    "type": "tableCell",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Row one, cell one"
                                }
                            ]
                        }
                    ]
                },
                {
                    "type": "tableCell",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Row one, cell two"
                                }
                            ]
                        }
                    ]
                }
            ]
        },
        {
            "type": "tableRow",
            "content": [
                {
                    "type": "tableCell",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Row two, cell one"
                                }
                            ]
                        }
                    ]
                },
                {
                    "type": "tableCell",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Row two, cell two"
                                }
                            ]
                        }
                    ]
                }
            ]
        },
        {
            "type": "tableRow",
            "content": [
                {
                    "type": "tableCell",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Row three, cell one"
                                }
                            ]
                        }
                    ]
                },
                {
                    "type": "tableCell",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Row three, cell two"
                                }
                            ]
                        }
                    ]
                }
            ]
        }
    ]
}
ADF
    ],
    'table with header' => [
        <<<'GFM'
| Header, cell one | Header, cell two |
| --- | --- |
| Row one, cell one | Row one, cell two |
| Row two, cell one | Row two, cell two |
| Row three, cell one | Row three, cell two |
GFM,
        <<<'ADF'
{
    "type": "table",
    "attrs": {
        "isNumberColumnEnabled": false,
        "layout": "default"
    },
    "content": [
        {
            "type": "tableRow",
            "content": [
                {
                    "type": "tableHeader",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Header, cell one"
                                }
                            ]
                        }
                    ]
                },
                {
                    "type": "tableHeader",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Header, cell two"
                                }
                            ]
                        }
                    ]
                }
            ]
        },
        {
            "type": "tableRow",
            "content": [
                {
                    "type": "tableCell",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Row one, cell one"
                                }
                            ]
                        }
                    ]
                },
                {
                    "type": "tableCell",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Row one, cell two"
                                }
                            ]
                        }
                    ]
                }
            ]
        },
        {
            "type": "tableRow",
            "content": [
                {
                    "type": "tableCell",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Row two, cell one"
                                }
                            ]
                        }
                    ]
                },
                {
                    "type": "tableCell",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Row two, cell two"
                                }
                            ]
                        }
                    ]
                }
            ]
        },
        {
            "type": "tableRow",
            "content": [
                {
                    "type": "tableCell",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Row three, cell one"
                                }
                            ]
                        }
                    ]
                },
                {
                    "type": "tableCell",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Row three, cell two"
                                }
                            ]
                        }
                    ]
                }
            ]
        }
    ]
}
ADF
    ],
    'table with number column' => [
        <<<'GFM'
| # | Header, cell one | Header, cell two |
| --- | --- | --- |
| 1 | Row one, cell one | Row one, cell two |
| 2 | Row two, cell one | Row two, cell two |
| 3 | Row three, cell one | Row three, cell two |
GFM,
        <<<'ADF'
{
    "type": "table",
    "attrs": {
        "isNumberColumnEnabled": true,
        "layout": "default"
    },
    "content": [
        {
            "type": "tableRow",
            "content": [
                {
                    "type": "tableHeader",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Header, cell one"
                                }
                            ]
                        }
                    ]
                },
                {
                    "type": "tableHeader",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Header, cell two"
                                }
                            ]
                        }
                    ]
                }
            ]
        },
        {
            "type": "tableRow",
            "content": [
                {
                    "type": "tableCell",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Row one, cell one"
                                }
                            ]
                        }
                    ]
                },
                {
                    "type": "tableCell",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Row one, cell two"
                                }
                            ]
                        }
                    ]
                }
            ]
        },
        {
            "type": "tableRow",
            "content": [
                {
                    "type": "tableCell",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Row two, cell one"
                                }
                            ]
                        }
                    ]
                },
                {
                    "type": "tableCell",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Row two, cell two"
                                }
                            ]
                        }
                    ]
                }
            ]
        },
        {
            "type": "tableRow",
            "content": [
                {
                    "type": "tableCell",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Row three, cell one"
                                }
                            ]
                        }
                    ]
                },
                {
                    "type": "tableCell",
                    "attrs": {},
                    "content": [
                        {
                            "type": "paragraph",
                            "content": [
                                {
                                    "type": "text",
                                    "text": "Row three, cell two"
                                }
                            ]
                        }
                    ]
                }
            ]
        }
    ]
}
ADF
    ],
]);
