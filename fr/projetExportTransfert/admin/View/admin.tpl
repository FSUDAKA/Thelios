{% extends "base.tpl" %}
{% block header %}
    {{ parent() }}
{% endblock %}

{% block arianne %}
    <div id="arianne"><a href="../index.php">Racine</a></div>
{% endblock %}

{% block content %}
    <form method="post" action="index.php" id="addUser">
        <fieldset>
            <legend>Créer un utilisateur</legend>
            <input type="text" name="username" placeholder="Nom d'utilisateur">
            <input type="text" name="password" placeholder="Mot de passe"><br>
            <div style="position: relative; width: 100%; text-align: center;">
            <select name="dbs[]" id="selectContent" class="selectContent">
                {% for database in databases %}
                    <option value="{{ database.id }}">{{ database.name }}</option>
                {% endfor %}
            </select>
            <div id="addSelect">+</div>
            <div style="clear:left;"></div>
            </div>
            <input type="checkbox" name="admin" value="1"> Administrateur<br>
            <input type="submit" name="send" value="Créer l'utilisateur">
        </fieldset>
    </form>


    <fieldset style="width: 300px; margin: auto; margin-top: 50px;">
        <legend>Utilisateurs</legend>

        <table border="1">
            <tr>
                <th>Username</th>
                <th>Administrateur</th>
                <th>Base de données</th>
                <th>Supprimer</th>
            </tr>
            {% for user in users %}
            <tr>
                <td>{{ user.username }}</td>
                <td>{{ user.admin }}</td>
                <td>{{ user.available_db }}</td>
                <td style="text-align: center;"><a href="index.php?id={{ user.id }}&action=delete">X</a></td>
            </tr>
            {% endfor %}
        </table>

    </fieldset>
{% endblock %}







