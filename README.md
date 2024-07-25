1.	Tenha instalado o laragon para executar o projeto, depois de instalado inicie-o
a.	Caso ele não apareça, clique no ícone oculto da barra de tarefas, se aparecer um ícone verde ou azul, clique apenas uma vez nele
2.	Altere as configurações do laragon
a.	Coloque os arquivos dentro da pasta projeto na pasta root (C:\laragon\www) e apague o index.php dentro da pasta root
b.	Caso não queria usar a pasta root, pode usar outra DÊS que a raiz da pasta seja o index.html 
c.	(Exemplo: C:\windows\pastaImportante\minhaPagina\projeto {arquivos})
3.	Carregue o banco de dados
a.	Vá projeto\Banco_De_Dados\banco.txt 
b.	Altere a primeira linha da parte Insert into, pois esse será o administrador
c.	Substitua o campo values seguindo a logica (‘nome’,’cpf’,’email’,não altere,não altere aqui) e salve
d.	Copie tudo, volte para tela do laragon clique em banco de dados>abrir
e.	Na terceira guia selecione consulta 
f.	Cole todo código do banco e aperte F9
4.	Altere a senha de admin
a.	No seu navegador escreva localhost e acesse a pagina
b.	Logue com o email de admin modificado na sessão 3.C e coloque a seguinte senha 12345 (padrão de todos usuarios)
c.	Clique em editar ao lado das informações de admin, e coloque sua senha de preferencia
