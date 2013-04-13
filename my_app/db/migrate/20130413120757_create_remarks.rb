class CreateRemarks < ActiveRecord::Migration
  def change
    create_table :remarks do |t|
      t.integer :id
      t.string :user_name
      t.string :user_email
      t.text :text
      t.datetime :created_at

      t.timestamps
    end
  end
end
