dump:
#dump all data
#	mysqldump --default-character-set=latin1 noc > noc.sql
#dump table create
	mysqldump -d --default-character-set=latin1 noc > noc.sql
	mysqldump --compact -d --default-character-set=latin1 noc IP JF_CAB JF_Server ODF ODFPAN file hist info jifang_daily ticket ticketdetail user userright > noc.sql
	mysqldump --compact --default-character-set=latin1 noc module >> noc.sql
