--a)
select nome
from fornecedor natural join (
	select nif, count(distinct categoria) as cat_forn
	from (
		select ean, forn_primario as nif, categoria
		from produto
		union
		select ean, nif, categoria
		from fornece_sec natural join produto) as A
	group by nif) as B
where cat_forn >= all(
	select cat_forn
	from (
		select count(distinct categoria) as cat_forn
		from (
			select ean, forn_primario as nif, categoria
			from produto
			union
			select ean, nif, categoria
			from fornece_sec natural join produto) as C
		group by nif) as D);


--b)
select nome, nif
from fornecedor natural join (
	select forn_primario as nif, categoria
	from produto) as A
natural join (
	select nome as categoria
	from categoria_simples) as B
group by nif
having 
	count(distinct categoria) = (
	select count(nome)
	from categoria_simples);

--c)
select ean
from produto
where ean not in (
	select ean from reposicao);

--d)
select ean
from fornece_sec
group by ean
having count(distinct nif) > 10;

--e)
select ean
from reposicao
group by ean
having count(distinct operador) = 1;