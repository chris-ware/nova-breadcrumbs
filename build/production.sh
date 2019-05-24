#!/bin/bash

(cd ../../laravel/nova/ && cp webpack.mix.js.dist webpack.mix.js && yarn && yarn prod)
yarn && yarn prod