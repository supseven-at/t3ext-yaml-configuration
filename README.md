# TYPO3 extension: yaml_configuration

## Features of `supseven/yaml-configuration`

* Export and import any table to and from a YAML file.
* Export a defined table to yaml in the TYPO3 backend interface.

> This extension was initially a fork of
> [Tuurlijk/t3ext-yaml-configuration (Branch task/9-5-lts)](https://github.com/Tuurlijk/t3ext-yaml-configuration/tree/task/9-5_lts).
> It was refactored for TYPO3 9.5 by
> [Josef Glatz](https://github.com/josefglatz/) in the source repository
> and became forked afterwards. With this step, we can perfectly
> continue to maintain the extension without external dependencies.

[![Latest Stable Version](https://poser.pugx.org/supseven-at/t3ext-yaml-configuration/v/stable)](https://packagist.org/packages/supseven/yaml-configuration)
[![Total Downloads](https://poser.pugx.org/supseven-at/t3ext-yaml-configuration/downloads)](https://packagist.org/packages/supseven/yaml-configuration)
[![Latest Unstable Version](https://poser.pugx.org/supseven-at/t3ext-yaml-configuration/v/unstable)](https://packagist.org/packages/supseven/yaml-configuration)
[![License](https://poser.pugx.org/supseven-at/t3ext-yaml-configuration/license)](https://packagist.org/packages/supseven/yaml-configuration)

## Installation

Clone it

```bash
git clone https://github.com/sup7even/t3ext-yaml-configuration.git yaml_configuration
```

Or install it using composer:

```bash
composer require supseven/yaml-configuration
```

Or install latest master branach using composer:


```bash
composer require supseven/yaml-configuration:dev-master
```

More information on [usage](Documentation/UserManual/Index.rst) and
[available commands](Documentation/CommandReference/Index.rst) can be
found in the [documentation folder](Documentation/Index.rst).

## Warnings

* Make a backup of your database before importing any YAML files

## License & Disclaimer

### Initial development

The `yaml_configuration` extension was initially developed by Michiel
Roos. Thanks for work in that area!

Copyright 2016 Michiel Roos

This Source Code Form is subject to the terms of the GNU General Public
License as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version. If a copy of the
GPL was not distributed with this file, You can obtain one at
http://www.gnu.org/copyleft/gpl.html

BECAUSE THE PROGRAM IS LICENSED FREE OF CHARGE, THERE IS NO WARRANTY FOR
THE PROGRAM, TO THE EXTENT PERMITTED BY APPLICABLE LAW. EXCEPT WHEN
OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES
PROVIDE THE PROGRAM "AS IS" WITHOUT WARRANTY OF ANY KIND, EITHER
EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. THE
ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PROGRAM IS WITH
YOU. SHOULD THE PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL
NECESSARY SERVICING, REPAIR OR CORRECTION.

IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED TO IN WRITING
WILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MAY MODIFY AND/OR
REDISTRIBUTE THE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR
DAMAGES, INCLUDING ANY GENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL
DAMAGES ARISING OUT OF THE USE OR INABILITY TO USE THE PROGRAM
(INCLUDING BUT NOT LIMITED TO LOSS OF DATA OR DATA BEING RENDERED
INACCURATE OR LOSSES SUSTAINED BY YOU OR THIRD PARTIES OR A FAILURE OF
THE PROGRAM TO OPERATE WITH ANY OTHER PROGRAMS), EVEN IF SUCH HOLDER OR
OTHER PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.

_See [LICENSE](LICENSE) for more details._

## Usage of the export Button

Set the Extension Configuration for Your needs to override
Extensionname, Path and Table. If You change the Extension Name, You
need to create the Export Folder or Configure a new one.
