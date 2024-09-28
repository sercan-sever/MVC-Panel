<?php

declare(strict_types=1);

class User extends Model
{
    /**
     * @param array $data
     *
     * @return array|false
     */
    public function auth(array $data): array|false
    {
        $data = flattenedData(data: $data);

        $user = $this->pdo->prepare("SELECT id, name, surname, email, phone, password, role FROM `users` WHERE email = ?");
        $user->execute([$data['email']]);
        $user = $user->fetch(PDO::FETCH_ASSOC);

        return ($user && password_verify($data['password'], $user['password'])) ? $user : false;
    }


    /**
     * @return array|false
     */
    public function allAdmin(): array|false
    {
        $users = $this->pdo->prepare("SELECT id, name, surname, email, phone FROM users WHERE role = ?");
        $users->execute([RoleEnum::ADMIN->value]);
        return $users->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * @param array $data
     *
     * @return array|false
     */
    public function getAdmin(array $data): array|false
    {
        $data = flattenedData(data: $data);

        $user = $this->pdo->prepare(query: "SELECT id, name, surname, email, phone FROM users WHERE id = ? AND role = ?");
        if (auth()['role'] == RoleEnum::ADMIN->value) {
            $data['id'] = auth()['id'];
        }

        $user->execute([$data['id'], RoleEnum::ADMIN->value]);
        return $user->fetch(PDO::FETCH_ASSOC);
    }


    /**
     * @param array $data
     *
     * @return array|false
     */
    public function create(array $data): array|false
    {
        $data = flattenedData(data: $data);
        $password = password_hash($data['password'], PASSWORD_BCRYPT);

        $user = $this->pdo->prepare("INSERT INTO `users` (name, surname, email, phone, password) VALUES (?, ?, ?, ?, ?)");
        $user->execute([$data['name'], $data['surname'], $data['email'], $data['phone'], $password]);

        if ($this->pdo->lastInsertId()) {
            $data['id'] = $this->pdo->lastInsertId();

            unset($data['password']);
            unset($data['password_confirm']);

            return $data;
        }

        return false;
    }


    /**
     * @param array $data
     *
     * @return array|false
     */
    public function update(array $data): array|false
    {
        $data = flattenedData(data: $data);
        $data['role'] = RoleEnum::ADMIN->value;

        if (!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            $user = $this->pdo->prepare(query: "UPDATE `users` SET name = :name, surname = :surname, email = :email, phone = :phone, password = :password WHERE id = :id AND role = :role");

            $user->bindParam(':password', $data['password']);

            if (auth()['id'] == $data['id']) {
                $_SESSION['auth']['change_password'] = 'change';
            }
        } else {
            $user = $this->pdo->prepare(query: "UPDATE `users` SET name = :name, surname = :surname, email = :email, phone = :phone WHERE id = :id AND role = :role");
        }

        $user->bindParam(':name', $data['name']);
        $user->bindParam(':surname', $data['surname']);
        $user->bindParam(':email', $data['email']);
        $user->bindParam(':phone', $data['phone']);
        $user->bindParam(':id', $data['id'], PDO::PARAM_INT);
        $user->bindParam(':role', $data['role']);

        if ($user->execute()) {
            unset($data['password']);
            unset($data['password_confirm']);

            return $data;
        }

        return false;
    }


    /**
     * @param array $data
     * 
     * @return array|false
     */
    public function delete(array $data): array|false
    {
        $data = flattenedData(data: $data);
        $user = $this->pdo->prepare(query: "DELETE FROM `users` WHERE id = ? AND role = ?");

        return $user->execute([$data['id'], RoleEnum::ADMIN->value]) ? $data : false;
    }
}
