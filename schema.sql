drop table if exists reposicao CASCADE;
drop table if exists evento_reposicao CASCADE;
drop table if exists planograma CASCADE;
drop table if exists prateleira CASCADE;
drop table if exists corredor CASCADE;
drop table if exists fornece_sec CASCADE;
drop table if exists fornecedor CASCADE;
drop table if exists produto CASCADE;
drop table if exists constituida CASCADE;
drop table if exists super_categoria CASCADE;
drop table if exists categoria_simples CASCADE;
drop table if exists categoria CASCADE;

create table categoria(
	nome varchar(80),
	primary key(nome));


create table categoria_simples(
	nome varchar(80),
	primary key(nome),
	foreign key(nome) references categoria(nome) ON DELETE CASCADE);


create table super_categoria(
	nome varchar(80),
	primary key(nome),
	foreign key(nome) references categoria(nome) ON DELETE CASCADE);


create table constituida(
	super_categoria varchar(80),
	categoria varchar(80),
	primary key(super_categoria,categoria),
	foreign key(super_categoria) references super_categoria(nome) ON DELETE CASCADE,
	foreign key(categoria) references categoria(nome) ON DELETE CASCADE);

create table fornecedor(
	nif varchar(9),
	nome varchar(80),
	primary key(nif),
	check (length(nif)=9));


create table produto(
	ean varchar(13),
	design varchar(80),
	categoria varchar(80),
	forn_primario varchar(9),
	data date,
	primary key(ean),
	foreign key(categoria) references categoria(nome) ON DELETE CASCADE,
	foreign key(forn_primario) references fornecedor(nif) ON DELETE CASCADE,
	check (length(ean)=13));


create table fornece_sec(
	nif varchar(9),
	ean varchar(13),
	primary key(nif,ean),
	foreign key(nif) references fornecedor(nif) ON DELETE CASCADE,
	foreign key(ean) references produto(ean) ON DELETE CASCADE);

create table corredor(
	nro integer,
	largura integer,
	primary key(nro));

create table prateleira(
	nro integer,
	lado varchar(20),
	altura varchar(20),
	primary key(nro, lado, altura),
	foreign key(nro) references corredor(nro) ON DELETE CASCADE,
	check(lado in ('esquerda', 'direita')),
	check(altura in ('baixo', 'medio','alto')));

create table planograma(
	ean varchar(13),
	nro integer,
	lado varchar(20),
	altura varchar(20),
	face integer,
	unidades integer,
	loc integer,
	primary key(ean,nro,lado,altura),
	foreign key(ean) references produto(ean) ON DELETE CASCADE,
	foreign key(nro,lado,altura) references prateleira(nro,lado,altura) ON DELETE CASCADE);

create table evento_reposicao(
	operador varchar(80),
	instante timestamp,
	primary key(operador,instante));

create table reposicao(
	ean varchar(13),
	nro integer,
	lado varchar(20),
	altura varchar(20),
	operador varchar(80),
	instante timestamp,
	unidades integer,
	primary key(ean,nro,lado,altura,operador,instante),
	foreign key(ean,nro,lado,altura) references planograma(ean,nro,lado,altura) ON DELETE CASCADE,
	foreign key(operador,instante) references evento_reposicao(operador,instante) ON DELETE CASCADE);




drop trigger if exists forn_ps_trigger on fornece_sec;

create or replace function forn_ps() returns trigger as $$
begin
	if new.nif in (select forn_primario from produto where ean=new.ean) then
	raise exception 'O fornecedor é fornecedor primário do produto';
	end if;
	return new;
End;
$$ Language plpgsql;

CREATE TRIGGER forn_ps_trigger BEFORE INSERT ON fornece_sec
FOR EACH ROW EXECUTE PROCEDURE forn_ps();



drop trigger if exists verifica_reposicao_trigger on evento_reposicao;

create or replace function verifica_reposicao() returns trigger as $$
DECLARE
    curtime timestamp;
begin
	curtime := now();
	if new.instante > curtime then
	raise exception 'O instante tem de ser anterior a data atual';
	end if;
	return new;
End;
$$ Language plpgsql;

CREATE TRIGGER verifica_reposicao_trigger BEFORE INSERT ON evento_reposicao
FOR EACH ROW EXECUTE PROCEDURE verifica_reposicao();




-- create index categoria_idx ON produto USING	HASH (categoria);