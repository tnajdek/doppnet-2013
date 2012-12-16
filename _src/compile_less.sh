#!/bin/bash
# compile less & compress css;
# requires lessc and clean-css - both available from npm
ROOT=`dirname $0`/../
lessc $ROOT/_src/less/doppnet.less > $ROOT/css/doppnet.css
cleancss -o $ROOT/css/doppnet.css $ROOT/css/doppnet.css