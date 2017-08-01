# ex: set tabstop=4 noexpandtab smarttab softtabstop=4 shiftwidth=4:
# -*- Mode: tab-width: 4; indent-tabs-mode: nil; basic-offset: 4 -*- #

SF_USER ?= unrtst1
SF_PROJ ?= jsgettext

.PHONY: all manifest dist doc readme website release clean

all: doc manifest readme

release: dist
	perl -e 'use YAML;';
	H=`pwd`; \
	N=`perl -MYAML -e 'print((YAML::LoadFile("META.yml"))->{name})'`; \
	V=`perl -MYAML -e 'print((YAML::LoadFile("META.yml"))->{version})'`; \
	D="$${N}-$${V}"; \
	scp "$${D}.tar.gz" $(SF_USER),$(SF_PROJ)@frs.sourceforge.net:/home/frs/project/j/js/jsgettext/

readme:
	perldoc -t lib/Gettext.js > README

manifest:
	find . -type f ! -name '*.bak' ! -name '.cvsignore' | \
	  grep -v CVS | \
	  sed 's/^.\///' | \
	  grep -v '^website' | \
	  grep -v '^Gettext-.....tar.gz$$' | \
	  sort > MANIFEST

dist: doc readme manifest META.yml
	perl -e 'use YAML;';
	H=`pwd`; \
	N=`perl -MYAML -e 'print((YAML::LoadFile("META.yml"))->{name})'`; \
	V=`perl -MYAML -e 'print((YAML::LoadFile("META.yml"))->{version})'`; \
	D="$${N}-$${V}"; \
	rm -fr "/tmp/$$D" && \
	cat MANIFEST | cpio -dump "/tmp/$$D" && \
	cd /tmp; tar czvf "$${D}.tar.gz" $$D && \
	rm -r $$D && \
	cd $$H && \
	mv "/tmp/$${D}.tar.gz" ./

website:
	make -C website
	make -C website install
	make -C website upload

doc:
	make -C doc

clean:
	make -C website clean
