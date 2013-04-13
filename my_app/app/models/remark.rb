class Remark < ActiveRecord::Base
  attr_accessible :created_at, :id, :text, :user_email, :user_name
  validates :user_name, :user_email, :text, presence: true
  validates :user_email, :allow_blank => false, format: {
      with: %r{^([^.@]+)(\.[^.@]+)*@([^.@]+\.)+([^.@]+)$},
      message: "Bad email address"
  }
end
