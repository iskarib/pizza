<?php
/**
 * Pizza E96
 *
 * @author: Paul Melekhov
 */

namespace App\Models;

/**
 * Пицца на сайте
 *
 * @property $id int                ID заказа
 * @property $delivery              Дата-время доставки в формате MySQL DATETIME
 * @property $created_ts            UNIX-time создания заказа
 * @property $status                Статус заказа
 * @property $creator               ID пользователя, создавшего заказ
 * @property $discount_absolute     Фиксированная скидка на заказ
 * @property $discount_percent      Процентная скидка на заказ
 * @property $note                  Примечание к заказу
 */
class OrdersRow extends AbstractRow
{
    const STATUS_ACTIVE = 0;        // Формируется (активный заказ)
    const STATUS_FIXED = 10;        // Зафиксирован (изменение невозможно, идёт заказ)
    const STATUS_ORDERED = 20;      // Заказан у поставщика
    const STATUS_DELIVERED = 30;    // Доставлен (возможно, съеден)
    const STATUS_CANCELLED = 40;    // Отменён

    /**
     * Возвращает текст статуса заказа в текстовом виде
     *
     * @return string
     */
    public function getCurrentStatusText()
    {
        return self::getStatusText($this->status);
    }

    public static function getStatusText($status)
    {
        switch ($status) {
            case \App\Models\OrdersRow::STATUS_ACTIVE : $text = "Формируется"; break;
            case \App\Models\OrdersRow::STATUS_FIXED : $text = "Сформирован"; break;
            case \App\Models\OrdersRow::STATUS_ORDERED : $text = "Заказан у поставщика"; break;
            case \App\Models\OrdersRow::STATUS_DELIVERED : $text = "Доставлен"; break;
            case \App\Models\OrdersRow::STATUS_CANCELLED : $text = "Отменён"; break;
            default : $text = "Неизвестный статус #{$status->status}";
        }
        return $text;
    }
}
